import React, {Fragment} from "react";
import { Link } from "react-router-dom";
export default () => {
  return (
    <Fragment>
      
      <footer className="border-top">
        <div className="row pt-4 bg-white w">
          <div className="col-md-8 align-self-center pb-3">
          <h2 className="text-center text-muted pb-4 font-weight-bold">Get our app</h2>
            <div className="text-center">
            <a href="https://play.google.com/store/apps/details?id=com.unistag.dlp" target="_blank">
            <img src={`/slides/android.png`} alt="Android" width="25%"/>
            </a>
            <Link to="/">
            <img src={`/slides/ios.png`} alt="ios" width="25%"/>
            </Link>
            </div>
          </div>
          <div className="col-md-4">
          <div className="text-center">
              <img src={`/slides/feat.jpg`} alt="unistag" width="50%"/>
            </div>
          </div>
        </div>
        
          <div className="row w py-4 d-flex social-bacground mb-5">
            <div className="col-md-6 col-lg-5 text-right my-2">
              <h6 className="text-white">Get connected with us on social networks!</h6>
            </div>
            <div className="col-md-6 col-lg-7 text-center my-2">
                <Link to={window.location.pathname}>
                   <i className="fab fa-facebook-f ic mr-4"></i>
                </Link>
                <Link to={window.location.pathname}>
                  <i className="fab fa-twitter ic mr-4"> </i>
                </Link>
                <Link to={window.location.pathname}>
                  <i className="fab fa-linkedin-in ic mr-4"> </i>
                </Link>
                <Link to={window.location.pathname}>
                  <i className="fab fa-instagram ic"> </i>
                </Link>
              </div>
          </div>
          <div className="row w mt-5">            
            <div className="col-md-3 col-lg-4 col-xl-3  offset-md-2">
            <Link to="/">
              <h6 className="text-uppercase font-weight-bold">Unistag</h6>
              </Link>
              <p>Unistag.com is an online shop in Dhaka, Bangladesh. We believe time is valuable to our fellow Dhaka residents, and that they should not have to waste hours in traffic, brave bad weather and wait in line just to buy basic necessities like eggs! This is why Unistag delivers everything you need right at your door-step and at no additional cost.</p>

            </div>
            <div className="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 className="text-uppercase font-weight-bold">CUSTOMER SERVICE</h6>
             
                <Link to={window.location.pathname} className="link">Contact Us</Link><br/>        
             
                <Link to={window.location.pathname} className="link">FAQ</Link>
           
            </div>
            <div className="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
              <h6 className="text-uppercase font-weight-bold">About Unistag</h6>
              <Link to={window.location.pathname} className="link">About Us</Link><br/>
              <Link to={window.location.pathname} className="link">Career</Link><br/>
              <Link to={window.location.pathname} className="link">Privacy Policy</Link><br/>
              <Link to={window.location.pathname} className="link">Terms of Use</Link><br/>

            </div>
            <div className="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">

              <h6 className="text-uppercase font-weight-bold">Contact</h6>
              <p>
                <i className="fas fa-home mr-3"></i> Sector-11, Uttara, Dhaka, Bangladesh</p>
              <p>
                <i className="fas fa-envelope mr-3"></i> info@unistag.com</p>
              <p>
                <i className="fas fa-phone mr-3"></i> +880 1611328179</p>

            </div>

          </div>
         
          <div className="footer-copyright text-center py-3 text-white">Copyright © { (new Date().getFullYear())}. All Right Reserved 
            <a href="https://dreamploy.com/" target="_blank" className="footer-link ml-2">Dreamploy</a>
          </div>
      </footer>
      </Fragment>
  );
};
