import React, { Component, Fragment } from "react";
import "./products.css";
class Notfound extends Component {
 
  render() {
    const {categoryName} = this.props;       
    return (
      <Fragment>
        <div className="row section bg-white mt-5 mb-5">
          <div className="col-md-12">
            <div className="row displayTop mb-3">
              <div className="col-6">
                <ul className="nav">
                    <li className="nav-item"><h3 className="th4" style={{ textTransform: 'capitalize'}}>{categoryName?categoryName:''}</h3></li>
                </ul>
              </div>
            </div>
          </div>          
            <div className="col-md-12 pb-3 lin mb-5 mt-5">
               <h3 className="pt-5 pb-5 text-center">Not found !</h3>
            </div>
        </div>     
        
      </Fragment>
    );
  }
}
export default Notfound;
