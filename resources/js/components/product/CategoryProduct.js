import React, { Component, Fragment } from 'react';
import { PropTypes } from 'prop-types';
import {connect} from 'react-redux';
import {CatProducts} from '../../actions/catProductAction';
import ProductVa from "../product/ProductVa.js";
import Notfound from "../product/Notfound.js";

class CategoryProduct extends Component {

componentDidMount(){
    this.props.CatProducts(this.props.match.params.slug);    
}

render() {  
  const {cat_products}=this.props.cat_products;  
  
    return (
      <Fragment>
        <div className="container pt-3">
        { cat_products.length > 0 ? <ProductVa  categoryName={this.props.match.params.slug} products={cat_products} />: <Notfound categoryName={this.props.match.params.slug}/> }
        </div>
      </Fragment>
    )
  }
}



  const mapStateToProps = state => ({
    cat_products: state.cat_products
  })
export default connect(mapStateToProps, {CatProducts})(CategoryProduct)