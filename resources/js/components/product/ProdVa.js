import React, { Component, Fragment } from 'react'
import { Link } from "react-router-dom";
import {connect} from 'react-redux';
import {addCartProduct} from '../../actions/cartAction';
class ProdVa extends Component { 
    
    constructor(props){
        super(props),
        this.state = {
            itemQty: 1,
        }
    }
    changelink(){
        this.forceUpdate();
            
            window.parent.location = window.parent.location.href;
        
    }
    
    onAddClick(item){
        const {itemQty} = this.state       
        const productItem = {
            product_id: item.id,
            variation_id: item.variation_id,
            merchant_id: item.merchant_id,
            name: item.name,
            slug: item.slug,
            color: item.color,
            size: item.size,
            unit: item.unit,
            price:item.price,
            v_price:item.v_price,
            image: item.images.trim().split('|')[0],
            qty: itemQty
        }
           
        this.props.addCartProduct(productItem);             
    }
    render() {
        const {product} = this.props;    
        
        
        
        
        
    return (
        <Fragment>               
            
        <div className="product-grid2" onClick={this.changelink.bind(this) }>
            <div className="product-image2">
            <Link  to={`/product/${product.slug}`} >
                <img src={`/product_images/${product.thumbnail.trim().split('|')[0]}`} alt="Alt Name" />
                
            </Link>
            <ul className="social">
                <li>
                    <Link to="#" data-tip="Quick View">
                        <i className="fa fa-eye" />
                    </Link>
                </li>
                <li>
                    <Link to="#" data-tip="Add to Wishlist">
                        <i className="fa fa-heart" />
                    </Link>
                </li>
            </ul>
            <Link to={window.location.pathname}>
            <button  className="add-to-cart" onClick={this.onAddClick.bind(this, product)}>Add to cart</button>
            </Link>
            </div>
            <div className="product-content">
            <h3 className="title">
                <Link to={`/product/${product.slug}`}>{product.name}</Link>
            </h3>
            <div className="row justify-content-start">
                <div className="col-4">
                    <span className="size">{product.size}{product.unit}</span>
                </div>
                <div className="col-8">
                    <span className="price">৳{product.price}</span><strike className="alt-price pl-2">{product.price + product.discount}</strike>
                </div>
            </div>
            </div>
        </div>
        </Fragment>
    )
  }
}
const mapStateToProps = (state) => ({
    auth: state.auth,
})
export default connect(mapStateToProps , {addCartProduct})(ProdVa);