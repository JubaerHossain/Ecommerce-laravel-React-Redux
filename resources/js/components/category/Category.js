import React, { Component, Fragment } from 'react';
import { PropTypes } from 'prop-types';
import {connect} from 'react-redux';
import {getCategoryProduct} from '../../actions/productAction';
import ProductVa from "../product/ProductVa.js";
import Notfound from "../product/Notfound.js";

class Category extends Component {

componentDidMount(){
    this.props.getCategoryProduct(this.props.match.params.string);
}
componentDidUpdate(prevProps) {
  if ((prevProps.match.params.string !== this.props.match.params.string)) {
    this.props.getCategoryProduct(this.props.match.params.string);
  }
}
render() {
  const { category } = this.props.category 
  
    return (
      <Fragment>
        <div className="container pt-3">
          { category.length > 0 ? <ProductVa categoryName={this.props.match.params.slug} products={category} />: <Notfound categoryName={this.props.match.params.slug}/> }
        </div>
      </Fragment>
    )
  }
}

Category.propTypes = {
  category: PropTypes.object.isRequired
}
const mapStateToProps = state => ({
  category: state.product
})
export default connect(mapStateToProps, {getCategoryProduct})(Category)