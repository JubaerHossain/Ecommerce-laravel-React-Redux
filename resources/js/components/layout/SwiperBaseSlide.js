import React, {Fragment} from 'react'
import Swiper from 'react-id-swiper';
import { Pagination, Navigation, Autoplay } from 'swiper/dist/js/swiper.esm'

const SwiperBaseSlide = () =>  {
const params = {
    loop: true,
    autoplay: {
        delay: 3000,
        disableOnInteraction: false
    },
    modules: [Pagination, Navigation, Autoplay],
    pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true
    }
    }
return (
    <Fragment>
        <div className="row mt-5">
            <div className="col-md-8">
                <Swiper {...params}> 
                        <div className="swiper-slide" id="1">
                            <img src={`/slides/slide1.jpg`} alt="Alt Name" />
                        </div>
                        <div className="swiper-slide" id="2">
                            <img src={`/slides/slide2.png`} alt="Alt Name" />
                        </div>
                        <div className="swiper-slide" id="3">
                            <img src={`/slides/slide3.jpg`} alt="Alt Name" />
                        </div>
                        <div className="swiper-slide" id="4">
                            <img src={`/slides/slide4.jpg`} alt="Alt Name" />
                        </div>
                </Swiper>
            </div>
            <div className="col-md-4 d-none d-md-block">
                <div className="sliderRight">
                    <img src={`/slides/slideRightA.jpg`} alt="Alt Name" />
                    <img src={`/slides/slideRightB.jpg`} alt="Alt Name" />            
                </div>
            </div>
        </div>
    </Fragment>
  )
}
export default SwiperBaseSlide;