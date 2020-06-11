import React, { Component, Fragment } from "react";
import { Link } from "react-router-dom";
import "./products.css";
import { throws } from "assert";

class Search extends Component {
 

  render() {
    const {product} = this.props;     
    return (
      <Fragment>
        <div className="bg-white" >
        <Link to={`/product/${product.slug}`} >
          <div className="card p-2 back">
          <div className="row">
            <div className="col-md-8 col-sm-4">
             <b className="pl-3">{product.name}</b><br></br>
             <span className="price pl-3">৳ {product.price}</span>
             <strike className="alt-price pl-2 discount"><small >{product.price != (product.price + product.discount)?product.price + product.discount:''}</small></strike><br/>
             <span className="size pl-3">{product.size} {product.unit}</span> 
            </div>
            <div className="col-md-4 col-sm-4">
            <img src={`/product_images/${product.thumbnail.trim().split('|')[0]}`} alt="Alt Name" className="img"/>
            </div>            
         </div>          
         </div>
         </Link>         
        </div>
      </Fragment>
    );
  }
}
export default Search;
