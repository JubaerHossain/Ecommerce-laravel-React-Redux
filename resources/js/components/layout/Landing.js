import React, { Component, Fragment } from "react";
import {PropTypes} from 'prop-types';
import {connect} from 'react-redux';
import { Link } from "react-router-dom";
import { getProduct, unmountProduct } from '../../actions/productAction';
import { getDiscountProduct } from '../../actions/productAction';
import ProductVa from "../product/ProductVa.js";
import ProductSwiperA from "../product/ProductSwiperA.js";
import SwiperBaseSlide from "../layout/SwiperBaseSlide";
import { getCategories } from '../../actions/categoryAction';
import Swiper from 'react-id-swiper';
import ProdVa from '../product/ProdVa';
// Need to add Pagination, Navigation modules

class Landing extends Component {
  componentDidMount() {
    this.props.getProduct();
    this.props.getCategories();
    this.props.getDiscountProduct();
  }

  render() {
    const {products} = this.props.products;     
    const {discount_product} = this.props.products;     
    const {procategory,categories} = this.props.categories;
   
   
    let productFeed;
   /*  if(products){
      productFeed = (
        <div>
          {products.length > 0  ? <ProductVa products={products}/>: null}
        </div>
      )
    } */
    return (
      <Fragment>
      <div className="container">
        <SwiperBaseSlide />
        <div className="largenav">
        <div className="row section bg-white mt-5 pb-4">
          <div className="col-md-12 displayTop mb-3">
             <h3 className="text-center th4">Product Category</h3>
          </div>
          {  procategory.length>0? [...new Set(procategory.map(p=> p.string.split(',')[1]))].map(p => 
             categories.length > 0 ? categories.map( cat => (cat.id == p) ? 
            <div className="col-md-3 pb-3 lin text-muted">
            <Link to={`/category/${cat.slug}/${cat.string}`}>
              <div className="cards p-3 bak"  key={cat.id}>
                <div className="card-body">
                  <b>{cat.name}</b> 
                </div>
              </div>
            </Link>
            </div>
          : null
          ): 'Wait, Category Loading ...'):null}
        </div>
        </div>
        <div className="row section bg-white mt-5 pb-4">
          <div className="col-md-12 Fashion">
             <h3 className="text-center th4">Fashion Gallery</h3>            
          </div>
              <div className="col-md-12 row pt-3">
                <div className="col-md-6">
                <Link to="/category/fashion-gallery/,113,">
                   <img src={`/category-image/fashion gallery.png`} alt="fashion-gallery" className="rm"/>
                </Link>
                </div>
                <div className="col-md-6 row">
                   <div className="pl-4 col-md-6">
                   <Link to="/category/mens-fashion/,113,114,">
                      <img src={`/category-image/men's fashion.png`} alt="men's-fashion" className=""/>
                      </Link>
                   </div>
                   <div className="pl-4 col-md-6">
                   <Link to="/category/womens-fashion/,113,115,">
                   <img src={`/category-image/women's fashion.png`} alt="women's-fashion" className=""/>
                   </Link>
                   </div>
                   <div className="pl-4 col-md-6">
                   <Link to="/category/babys-fashion/,113,116,">
                   <img src={`/category-image/baby's fashion.png`} alt="baby's-fashion" className=""/>
                   </Link>
                   </div>
                   <div className="pl-4 col-md-6">
                   <Link to="/category/handicrafts/,111,">
                   <img src={`/category-image/handicraft's fashion.png`} alt="handicraft's-fashion" className=""/>
                   </Link>
                   </div>
                </div>
              </div>
        </div>
       { discount_product.length > 0  ?
        <div className="row section bg-white mt-5">
          <div className="col-md-12">
            <div className="row  displayTop mb-3">
              <div className="col-6">
                <ul className="nav">
                    <li className="nav-item"><h3 className="th4">Flash Sale</h3></li>
                </ul>
              </div> 
              { discount_product.length > 8  ?
          <div className="col-6 nav justify-content-end">
             <Link to="/category-products/flash-sale">
                <button className="btn btn-outline-warning">Shop more</button>
              </Link>
           </div>    
           :null
          }             
            </div>
          </div>

          { discount_product.length > 0  ?
            discount_product.map((product,i) => i <=7 ? <div key={product.id} className="col-md-3 col-6 col-xs-6 mb-2"><ProdVa key={product.id} product={product} /></div>:null
          )
          :null
          } 
              
        </div>
         :null
        }
        <div className="row section bg-white mt-5">
          <div className="col-md-12">
            <div className="row displayTop mb-3">
              <div className="col-6">
                <ul className="nav">
                    <li className="nav-item"><h3 className="th4">Latest sale</h3></li>
                </ul>
              </div>
              { products.length > 8  ?
              <div className="col-6 nav justify-content-end">
                <Link to="/category-products/latest-sale">
                    <button className="btn btn-outline-warning">Shop more</button>
                  </Link>
              </div>    
           :null
          }
            </div>
          </div>          
          {
            products.length > 0  ?
            products.map((product,i) => i <= 7 ?  <div key={product.id} className="col-md-3 col-6 col-xs-6 mb-2"><ProdVa key={product.id} product={product} /></div>:null
          ):null
        }
         
        </div> 
        {productFeed}
        {products.length > 0 ? <ProductSwiperA products={products}/>: null}
      </div>
      </Fragment>
    );
  }
}
Landing.propTypes = {
  getProduct: PropTypes.func.isRequired,
  auth: PropTypes.object.isRequired,
  products: PropTypes.object.isRequired,
  
}
const mapStateToProps = (state) => ({
  auth: state.auth,
  products: state.product,
  categories: state.category,
})
export default connect(mapStateToProps, {getProduct,unmountProduct,getCategories,getDiscountProduct})(Landing);
