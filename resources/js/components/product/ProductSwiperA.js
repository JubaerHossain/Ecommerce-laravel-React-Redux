import React, { Component, Fragment } from "react";
import ProdVa from './ProdVa';
import "./products.css";
import Swiper from 'react-id-swiper';
// Need to add Pagination, Navigation modules
import { Pagination, Navigation } from 'swiper/dist/js/swiper.esm'

class ProductSwiperA extends Component {

  render() {
    const {products} = this.props;
    const params = {
        slidesPerView: 'auto',
        freeMode: true,
        modules: [Pagination, Navigation],
        /* pagination: {
          el: '.swiper-pagination',
          type: 'bullets',
          clickable: true
        }, */
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev'
        },
      }
    return (
      <Fragment>
      <div className="row section bg-white mt-5">
        <h4 className="pl-4 pt-4 pb-2"><strong>Best Deals</strong></h4>
        <Swiper {...params}>{products.map(prod => 
          <div key={prod.id} className="col-md-3">
              <div className="swiper-slide text-center">
                  <ProdVa key={prod.id} product={prod} />
              </div>
          </div>)}
        </Swiper>
      </div>
      </Fragment>
    );
  }
}
export default ProductSwiperA;
