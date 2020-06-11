import React, { Component,Fragment } from 'react'
import { PropTypes } from 'prop-types';
import {connect} from 'react-redux';
import RightNav from '../common/RightNav'
import TextFieldGroup from '../common/TextFieldGroup';
import {userDpid} from '../../actions/authActions';
import {userDm} from '../../actions/profileAction';

class Affiliate extends Component {
    constructor() {
        super();
        this.state = {
            dpid: "",
            errors: {}
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }
    componentDidMount(){
        if(this.props.auth.user.role.trim().split(',').includes('affiliator')){
            this.props.userDm()
        }
    }
    onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    onSubmit(e) {
        e.preventDefault();
        const userID = {
            dpid: this.state.dpid
        };
        this.props.userDpid(userID);
    }
  render() {
    const {user} = this.props.auth
    const {affiliators} = this.props.profile
    const {errors} = this.state;
    return (
        <Fragment>
        <div className="container mt-5">
          <div className="row">
              <div className="col-md-2">
                  <RightNav />
              </div>
              <div className="col-md-10">
                {user.dpid ? 
                    <h4>Youd ID # {user.dpid + 100000}</h4> 
                : 
                <form onSubmit={this.onSubmit} className="col-md-4">
                    <TextFieldGroup 
                    placeholder="DLP ID"
                    name="dpid" 
                    type="number" 
                    value={this.state.dpid}
                    onChange={this.onChange}
                    error={errors.dpid ? errors.dpid[0]: null}
                    />
                    <button
                        type="submit"
                        className="btn btn-outline-success btn-block"
                    >
                        Save
                    </button>
                </form>
                }
                <hr />

                <h4>Your Affiliators</h4>
                <div className="row">
                    {affiliators.length > 0 ? affiliators.map(aff => <div className="col-md-4">

                        <div className="card">
                            <div className="card-body">
                                <h5 className="card-title">{aff.name}</h5>
                                <h6 className="card-subtitle pb-3 text-muted">Joined: {aff.created_at}</h6>
                                <h6 className="card-subtitle pb-3">Phone Number: {aff.phone}</h6>
                                <span className="card-link">District: {aff.customer.district}</span>
                                <span className="card-link">City {aff.customer.city}</span>
                                <span className="card-link">Street: {aff.customer.street}</span>
                                <p className="card-text">{aff.customer.address}</p>
                            </div>
                        </div>
                    </div>) : null }
                    
                </div>
              </div>
          </div>
        </div>
        </Fragment>
      )
  }
}
Affiliate.propTypes = {
    auth: PropTypes.object.isRequired,
    profile: PropTypes.object.isRequired
}
const mapStateToProps = state => ({
    auth: state.auth,
    profile: state.profile
})
export default connect(mapStateToProps, {userDpid,userDm})(Affiliate)