import React, { Component,Fragment } from "react";
import {PropTypes} from 'prop-types';
import {connect} from 'react-redux';
import { getProfile,updateProfile } from '../../actions/profileAction';
import { postCartProducts } from '../../actions/cartAction';
import { getCategories } from '../../actions/categoryAction';
import { getDivisions, getDistricts } from '../../actions/placeAction';
import TextFieldGroup from '../common/TextFieldGroup'
import SelectListGroup from '../common/SelectListGroup'
import isEmpty from '../../validation/is-empty';
import ProductSwiperA from "../product/ProductSwiperA.js";
import { deleteProduct } from '../../actions/cartAction';
class Checkout extends Component {
  constructor(props){
    super(props);
    this.state = {
      division: '',
      district: '',
      city: '',
      street: '',
      phone: '',
      address: '',
      cart: [],
      subtotal: 0,
      shipping: 0,
      discount: 0,
      errors: {},
      visible: false,
    }
    
    this.onChange = this.onChange.bind(this);
  }
  componentDidMount() {
    this.props.getProfile();
    this.props.getCategories();
    this.props.getDivisions();
  }
  componentWillReceiveProps(nextProps){
    
    if(nextProps.errors){
      this.setState({errors:nextProps.errors})
    }
    if (this.props.auth) {
      const {user}=this.props.auth;
      this.setState({
        phone: user.phone,
      })     
      
    }
    if(this.props.cart){
      const price = this.props.cart.price > 500 ? 0 : 50
      this.props.cart.items.map(cart => {        
        var afff_id=cart.aff_id
      })
      setInterval(() => {      
        this.setState({
          cart: this.props.cart, 
          subtotal: this.props.cart.price,
          shipping: price,
        });
      }, 1000);
    }

    if(nextProps.profile.profile){
      const profile = this.props.profile.profile;

      profile.division = !isEmpty(profile.division) ? profile.division : '';
      profile.district = !isEmpty(profile.district) ? profile.district : '';
      profile.city = !isEmpty(profile.city) ? profile.city : '';
      profile.street = !isEmpty(profile.street) ? profile.street : '';
      profile.address = !isEmpty(profile.address) ? profile.address : '';
      this.setState({
        division: profile.division,
        district: profile.district,
        city: profile.city,
        street: profile.street,
        address: profile.address,
      })
    }
  }
  onChange(e){
    this.setState({[e.target.name]: e.target.value});     
    if(e.target.name == 'division'){
      this.props.getDistricts(e.target.value);
    }
  }
  orderNow(e){
    if (!this.state.division && !this.state.district && !this.state.city && !this.state.street && !this.state.address) {   
      alert('Please fill up your address information')
    }
    else{
      console.log(e.target.value);
      
    const order = {
      address: {
        division: this.state.division,
        district: this.state.district,
        city: this.state.city,
        street: this.state.street,
        address: this.state.address
      },
      products: this.state.cart,
      aff_id: localStorage.getItem('aff_id'),
      merchant_id: this.state.cart.items[0].merchant_id,
      user_id: this.props.auth.user.id,
      did: this.props.auth.user.dpid,
      email: '',
      phone: this.state.phone,
      subtotal: this.state.subtotal,
      shipping: this.state.shipping,
      discount: this.state.discount,
      total: this.state.subtotal + this.state.shipping,
    }  
     this.props.postCartProducts(order); 
     
     this.setState({
      subtotal: 0,
      shipping: 0,
      visible:true,
    })
      setTimeout(() =>this.setState({ visible: false }),  3000)        

        this.props.cart.items.map(cart => {
          this.props.deleteProduct(cart.variation_id);
        }) 
  }
}

  render() {
    const {user} = this.props.auth;
    const { errors } = this.state;
    const { items } = this.props.cart
    var {districts} = this.props.place;
    const {products} = this.props.products; 
    let classes = this.state.visible == true ? 'visible' : 'none' 
    const profile = this.props.profile.profile;
    const dissabled= items.length > 0 ? '' :'none'
    
    
    return (
      <Fragment>
      <div className="container mt-5">
        <div className="row">
          <div className="col-md-6">
            <h3 className="text-center">Your address information</h3>
            <div className="card">
                <div className="card-body">
                    <form onSubmit={this.onSubmit}>
                    <div className="form-group">
                      <p>{this.state.division}</p>
                      <select className="form-control form-control-lg"  name="division" onChange={this.onChange}>
                      {!profile.division?
                      this.props.place.divisions.length > 0 ? this.props.place.divisions.map( div => 
                        <option key={div.id} selected={div.name}>{div.name}</option>
                        ):null:
                        <option>{this.state.division}</option>
                        }
                        </select>
                        </div> 
                        { this.props.place.districts.length > 0 ? 
                        <SelectListGroup 
                        label="District"
                        placeholder="District"
                        name="district" 
                        value={this.state.district}
                        onChange={this.onChange}
                        options={ this.props.place.districts}
                        error={errors.district ? errors.district[0]: null}

                        /> : null}
                        <TextFieldGroup 
                        label="City"
                        placeholder="City"
                        name="city" 
                        type="text" 
                        value={this.state.city}
                        onChange={this.onChange}
                        error={errors.city ? errors.city[0]: null}

                        />
                        <TextFieldGroup 
                        label="Street"
                        placeholder="Street"
                        name="street" 
                        type="text" 
                        value={this.state.street}
                        onChange={this.onChange}
                        error={errors.street ? errors.street[0]: null}
                        />
                        <TextFieldGroup 
                        label="Full Address"
                        placeholder="Full Address"
                        name="address" 
                        type="text" 
                        value={this.state.address}
                        onChange={this.onChange}
                        error={errors.address ? errors.address[0]: null}
                        info="Your full address so that we can ship your product at your door."
                        />
                        <TextFieldGroup 
                        placeholder="Phone Number"
                        name="phone" 
                        type="text" 
                        value={this.state.phone}
                        onChange={this.onChange}
                        error={errors.phone ? errors.phone[0]: null}
                        info="Your full address so that we can ship your product at your door."
                        />
                    </form>
              </div>
            </div>
          </div>
          <div className="col-md-6">

            {this.state.updateProfile ? this.state.updateProfile: null}
                <h4>Your Cart</h4>
                <table className="table">
                    <thead>
                    <tr>
                        <td>Item</td>
                        <td>Color</td>
                        <td>Size</td>
                        <td>Qty</td>
                        <td>price</td>
                        <td>Total</td>
                    </tr>
                    {items.map(cart => 
                               <tr key={cart.variation_id}>
                                <td>{cart.name}</td>
                                <td>{cart.color}</td>
                                <td>{cart.size}</td>
                                <td>{cart.qty}</td>
                                <td>{cart.price}</td>
                                <td>{cart.qty * cart.price}</td>
                            </tr>
                        )}
                    <tr>
                        <td colSpan="6" className="text-right">Total - {this.state.subtotal ? this.state.subtotal : 0}</td>
                    </tr><tr>
                        <td colSpan="6" className="text-right">Shipping - {this.state.shipping ? this.state.shipping : 0}</td>
                    </tr><tr>
                        <td colSpan="6" className="text-right">Grand Total - {( this.state.subtotal ? this.state.subtotal : 0 ) + ( this.state.shipping ? this.state.shipping : 0 )}</td>
                    </tr>
                    </thead>
                </table>
                <button className={`btn btn-outline-success ${dissabled}`} onClick={this.orderNow.bind(this) }>Place Order</button>

          </div>
          <div className={classes}>
           <p>Thank you for purchase</p>
          </div>
        </div>
          {products.length > 0 ? <ProductSwiperA products={products} />: null}
      </div>
      </Fragment>
    );
  }
}
Checkout.propTypes = {
  getProfile: PropTypes.func.isRequired,
  getCategories: PropTypes.func.isRequired,
  getDivisions: PropTypes.func.isRequired,
  auth: PropTypes.object.isRequired,
  profile: PropTypes.object.isRequired,
  place: PropTypes.object.isRequired,
  errors:PropTypes.object.isRequired,
  cart: PropTypes.object.isRequired,
  products: PropTypes.object.isRequired,
}
const mapStateToProps = (state) => ({
  auth: state.auth,
  profile: state.profile,
  category: state.category,
  errors: state.errors,
  place: state.place,
  cart: state.cart,
  products: state.product,
})
export default connect(mapStateToProps, {getProfile,updateProfile,getCategories,getDivisions,getDistricts,postCartProducts,deleteProduct})(Checkout);


