import React, { Component, Fragment } from "react";
import ProdVa from './ProdVa';
import "./products.css";
import Swiper from 'react-id-swiper';
class ProductVa extends Component {
 
  render() {
    const {products,categoryName} = this.props; 
      
    return (
      <Fragment>
        <div className="row section bg-white mt-5">
          <div className="col-md-12">
            <div className="row displayTop mb-3">
              <div className="col-6">
                <ul className="nav">
                    <li className="nav-item"><h3 className="th4" style={{ textTransform: 'capitalize'}}>{categoryName?categoryName:'Latest sale'}</h3></li>
                </ul>
              </div>
            </div>
          </div>          
          {products.map(product =>  <div key={product.id} className="col-md-3 col-6 col-xs-6 mb-2"><ProdVa key={product.id} product={product} /></div>
          )}
        </div>        
        
      </Fragment>
    );
  }
}
export default ProductVa;
