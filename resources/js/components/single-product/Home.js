import React, {iframe, Component, Fragment } from 'react';
import {FacebookShareButton,LinkedinShareButton,TwitterShareButton,FacebookIcon,TwitterIcon,LinkedinIcon,FacebookShareCount} from 'react-share';
import { PropTypes } from 'prop-types';
import {connect} from 'react-redux';
import {getSingleProduct} from '../../actions/productAction';
import {addCartProduct} from '../../actions/cartAction';
import ReactImageMagnify from 'react-image-magnify';
import isEmpty from '../../validation/is-empty';
import ProductSwiperA from "../product/ProductSwiperA.js";
import { Helmet } from 'react-helmet';
class Home extends Component {
    constructor(props){
        super(props),
        this.state = {
            zoomImage: '',
            sColor: '',
            sVar: {},
            itemQty: 1,
            aff_id:'',
            cart: [],
        }
        this.onChange = this.onChange.bind(this);
    }
    onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    componentDidMount() {      
             
        this.props.getSingleProduct(this.props.match.params.slug);        
        if (this.props.match.params.id) {           
             let id=this.props.match.params.id;             
            localStorage.setItem('aff_id', id);
        }
        
    }
    componentWillReceiveProps(nextProps){
        if(nextProps.product.product){
            const { product } = nextProps.product
            if(Object.keys(product).length > 0){
                product.images = !isEmpty(product.images) ? product.images : '';
                localStorage.setItem('img', product.images.trim().split('|')[0]);
                this.setState({
                    zoomImage: `/product_images/${ product.images.trim().split('|')[0] }`,
                    sColor: product.variations[0].color,
                    sVar: product.variations[0]
                })
            }
        }
    }
    changeImage (image) {
        this.setState({zoomImage: image });
    }
    colorSize (color) {
        const { product } = this.props.product
        if(Object.keys(product).length > 0){
            const selImage = product.variations.filter(item => item.color == color);
            this.setState({
                sColor: color ,
                sVar: selImage[0],
                zoomImage: `/product_variation/${selImage[0].image}`,
            });
        }
    }
    selVar(selVar){
        this.setState({sVar:selVar})
    }
    incDec(stat){
        const {itemQty, sVar} = this.state;
        if(!isEmpty(sVar)){
            if(stat == 'inc'){
                if(itemQty >= 1 && itemQty < 10){
                    this.setState({itemQty: itemQty + 1})
                }
            }else{
                if(itemQty > 1 && itemQty <= 10){
                    this.setState({itemQty: itemQty - 1})
                }
            }
        }else{
            alert('Choose a Variation')
        }
    }
    onAddClick(item){
        const {sVar,itemQty} = this.state
        if(isEmpty(sVar)){
            alert('Select Variation');
            return false;
        }
        this.setState({
            sColor: item.color,
            sVar: item
        })
        const productItem = {
            product_id: item.id,
            variation_id: sVar.id,
            merchant_id: (this.props.product.product ? this.props.product.product.merchant_id : null),
            name: item.name,
            slug: item.slug,
            color: sVar.color,
            size: sVar.size,
            unit: sVar.unit,
            price:sVar.price,
            v_price:sVar.v_price,
            aff_id:localStorage.getItem('aff_id'),
            image: item.images.trim().split('|')[0],
            qty: itemQty
        }           
         this.props.addCartProduct(productItem);         
    }

    render() {
        const { product, products } = this.props.product
        const { zoomImage, sColor, sVar } = this.state
        const { items, price } = this.props.cart
        const {user} = this.props.auth;
        const urll=user.dpid;
        const urls =window.location.href;
        const url=`${urls}/${urll}`;  
        
               
        /* document.getElementsByTagName("META")[2].content=`${window.origin}${zoomImage}` */
        let productData;
        if(Object.keys(product).length > 0){
            let colors = [...new Set(product.variations.map(item => item.color))];
            let images = [...new Set(product.variations.map(item => item.image))];
            let variations = product.variations.map(item => item);
            
            let description=product.properties.description;
            const colorVar = product.variations.filter(colorVar => colorVar.color == sColor);
                
            productData = <div className="product">
            <div className="row">
            <Helmet>
					<meta property="og:url" content={url} />
					<meta property="og:image" content={`${window.origin}${zoomImage}`} itemProp="image" />
					<meta property="og:image:url" content={`${window.origin}${zoomImage}`} itemProp="image" />
					<meta property="og:image:width" content="700" />
					<meta property="og:image:height" content="400" />
					<meta property="og:description" content={description} itemProp="name" />
			</Helmet>

                <div className="col-md-4" style={{zIndex: 1}}>
                    <div className="productMagnify">
                        <ReactImageMagnify {...{
                            smallImage: {
                                alt: product.name,
                                isFluidWidth: true,
                                src: zoomImage,
                            },
                            largeImage: {
                                src: zoomImage,
                                width: 1200,
                                height: 1000,
                            }
                        }} />
                    </div>
                    <div className="productThumbnails">
                        {product.images.trim().split('|').map((img, i) => 
                            <img key={i} 
                                style={{width: '100px'}} 
                                onClick={this.changeImage.bind(this, `/product_images/${img}`)} 
                                src={`/product_images/${img}`} 
                                alt={product.name} 
                            />
                        )}
                        
                        {images.map((imgs, i) => imgs != null ? 
                            <img key={i}
                                style={{width: '100px'}} 
                                onClick={this.changeImage.bind(this, `/product_variation/${imgs}`)} 
                                src={`/product_variation/${imgs}`} 
                                alt={product.name}
                            /> : null
                        )}
                    </div>
                </div>
                <div className="col-md-5" style={{zIndex: 0}}>
                    <div className="productDescription">
                        <h5><b>{product.name}</b></h5>
                        <p>{product.properties.description}</p>
                        <h5><strong>Brand Name:</strong>  {product.brand}</h5>                        
                       {                           
                           variations.map(item => item ?
                            <h5 key={item.id}><strong>Price:</strong> <b className="red"> ৳  {item.price}</b> <small className="m"><strike className="alt-price pl-2 text-muted"> ৳ {item.price + item.discount}</strike></small></h5>
                            :null )
                        }

                        {colors.length <= 1 ? null : <h4>Colors: <br />
                            {colors.map(color => 
                                <i  key={color}
                                    onClick={this.colorSize.bind(this, color)} 
                                    className="fa fa-circle m-2" 
                                    style={{"color": color, cursore: 'pointer', padding: '5px 7px', borderRadius: '50%', border: (color == sColor) ? '2px solid rgb(218, 218, 218)': null}}
                                ></i>)}
                        </h4>}
                        {colorVar.length <= 1 ? null : 
                            <h4>Choose Size:<br /><br />
                            {colorVar.map(v => 
                                <button key={v.id} onClick={this.selVar.bind(this, v)} type="button" className={"btn btn-outline-primary mb-2 ml-1 " + (sVar.id === v.id ? "bg-info" : null)}>{v.size} </button>
                            )}</h4>
                        }
                        
                        <div className="col-md-6 input-group mb-3" style={{paddingLeft: '0px'}}>
                            <div className="input-group-prepend">
                                <button onClick={this.incDec.bind(this, 'dec')} className="btn btn-dark" id="minus-btn"><i className="fa fa-minus"></i></button>
                            </div>
                            <input 
                                style={{textAlign: 'center'}} 
                                type="number" 
                                name="itemQty"
                                className="form-control" 
                                min="1"
                                value={this.state.itemQty}
                                onChange={this.onChange}
                             />
                            <div className="input-group-prepend">
                                <button onClick={this.incDec.bind(this, 'inc')} className="btn btn-dark" id="plus-btn"><i className="fa fa-plus"></i></button>
                            </div>
                        </div>
                        <button onClick={this.onAddClick.bind(this, product)} className="btn btn-outline-info">Add To Cart</button>
                    </div>
                    <div className="col-auto row p-5  my-2 bg-blue">
                   
                    <div className="col-md-12">
                    <h6 className="text-dark pb-2">Share  on your social networks!</h6></div> 
                    <div className="col-md-2">
                    <FacebookShareButton
                        url={url}
                        quote={product.name}
                        className="Demo__some-network__share-button"
                        hashtag={`#Unistag`}                     >
                        <FacebookIcon
                        size={32}
                        round />
                   </FacebookShareButton>
                     
                    </div>
                    <div className="col-md-2">
                    <LinkedinShareButton
                        url={url}
                        quote={product.name} 
                      className="Demo__some-network__share-button">
                        <LinkedinIcon
                        size={32} round />
                        </LinkedinShareButton>
                    </div>
                    <div className="col-md-2">
                    <TwitterShareButton
                        url={url}
                        quote={product.name}   
                        className="Demo__some-network__share-button" via='Unistag'>
                       <TwitterIcon
                        size={32} round />
                        </TwitterShareButton> 
                    </div>
                                         
                                          
                                         
                   </div>
                </div>
                <div className="col-md-3" style={{zIndex: 0}}>
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
                        <tr><td colSpan="6" className="text-right">Total - {price}</td></tr>
                        </thead>
                    </table>
                </div>
            </div>
            {products.length > 0 ? <ProductSwiperA products={products} />: null}
            </div>
        }else{
            productData = null;
        }

        
        return (
            <Fragment>
                <div className="container mt-5">
                    {productData}
                </div>
            </Fragment>
        )
    }
}
Home.propTypes = {
    product: PropTypes.object.isRequired,
    cart: PropTypes.object.isRequired
}
const mapStateToProps = (state) => ({
    auth: state.auth,
    product: state.product,
    cart: state.cart
})
export default connect(mapStateToProps , {getSingleProduct, addCartProduct})(Home);