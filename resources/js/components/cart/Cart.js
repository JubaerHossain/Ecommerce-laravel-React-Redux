import React, { Component,Fragment } from 'react';
import { PropTypes } from 'prop-types';
import {connect} from 'react-redux';
import { Link } from "react-router-dom";
import { deleteProduct, addQty, minusQty } from '../../actions/cartAction';
import ProductSwiperA from "../product/ProductSwiperA.js";

class Cart extends Component {

deleteCartProduct(id){
    this.props.deleteProduct(id)
}
minusQty(id){
    this.props.minusQty(id)
}
addQty(id){
    this.props.addQty(id)
}

render() {
    const { items, price } = this.props.cart
    const {products} = this.props.products;
    return (
        <Fragment>
      <div className="container mt-5">
        <div className="row">
            <div className="col-md-12 pb-3" style={{zIndex: 0}}>
                <h4>Your Cart</h4>
                <table className="table">
                    <thead>
                    <tr>
                        <td>Item</td>
                        <td>Qty</td>
                        <td>price</td>
                        <td>Total</td>
                        <td></td>
                    </tr>
                    {items.map(cart => 
                            <tr key={cart.variation_id}>
                                <td>
                                    <h4>{cart.name}</h4>
                                    <p><strong>{cart.color}</strong><strong>{cart.size}</strong></p>
                                </td>
                                <td><p><button className="btn btn-sm btn-info mr-3" onClick={this.minusQty.bind(this, cart.variation_id)}><i className="fa fa-minus"></i></button><strong>{cart.qty}</strong><button className="btn btn-sm btn-info ml-3" onClick={this.addQty.bind(this, cart.variation_id)}><i className="fa fa-plus"></i></button></p></td>
                                <td>{cart.price}</td>
                                <td>{cart.qty * cart.price}</td>
                                <td><i className="fa fa-close" onClick={this.deleteCartProduct.bind(this, cart.variation_id)}></i></td>
                            </tr>
                        )}
                    <tr><td colSpan="7" className="text-right">Total - {price}</td></tr>
                    </thead>
                </table>
                <Link className="btn btn-outline-primary" to={items.length == 0 ?window.location.pathname:'/checkout-order'}>
                    Proceed To Checkout
                </Link>
            </div>
        </div>
            {products.length > 0 ? <ProductSwiperA products={products} />: null}
      </div>
      </Fragment>
    )
  }
}
Cart.propTypes = {
    cart: PropTypes.object.isRequired,
    products: PropTypes.object.isRequired,
}
const mapStateToProps = (state) => ({
    cart: state.cart,
    products: state.product,
})
export default connect(mapStateToProps , {deleteProduct, addQty, minusQty})(Cart);