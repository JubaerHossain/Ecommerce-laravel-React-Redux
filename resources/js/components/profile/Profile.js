import React, { Component, Fragment } from "react";
import {PropTypes} from 'prop-types';
import {connect} from 'react-redux';
import { getProfile,updateProfile } from '../../actions/profileAction';
import { getCategories } from '../../actions/categoryAction';
import { getDivisions, getDistricts } from '../../actions/placeAction';
import Spinner from '../common/Spinner';
import TextFieldGroup from '../common/TextFieldGroup'
import SelectListGroup from '../common/SelectListGroup'
import Select from 'react-select';
import isEmpty from '../../validation/is-empty';


class Profile extends Component {
  constructor(props){
    super(props);
    this.state = {
      updateProfile: false,
      division: '',
      district: '',
      city: '',
      street: '',
      address: '',
      errors: {}
    }
    
    this.onChange = this.onChange.bind(this);
    this.onSubmit = this.onSubmit.bind(this);
  }
  onSubmit(e){
    e.preventDefault();
    const profileData = {
      division: this.state.division,
      district: this.state.district,
      city: this.state.city,
      street: this.state.street,
      address: this.state.address
    }

    this.props.updateProfile(profileData);
  }
    componentDidMount() {
      this.props.getProfile();
      this.props.getCategories();
      this.props.getDivisions();
    }
  componentWillReceiveProps(nextProps){
    if(nextProps.errors){
      this.setState({errors:nextProps.errors})
    }

    if(this.props.profile.profile){
      const profile = this.props.profile.profile;

      profile.division = !isEmpty(profile.division) ? profile.division : '';
      profile.district = !isEmpty(profile.district) ? profile.district : '';
      profile.city = !isEmpty(profile.city) ? profile.city : '';
      profile.street = !isEmpty(profile.street) ? profile.street : '';
      profile.address = !isEmpty(profile.address) ? profile.address : '';
      this.setState({
        division: profile.division,
        district: profile.district,
        city: profile.city,
        street: profile.street,
        address: profile.address,
      })
    }
  }
  onChange(e){
    this.setState({[e.target.name]: e.target.value});
    if(e.target.name == 'division'){
      this.props.getDistricts(e.target.value);
    }
  }


  render() {
    const {user} = this.props.auth;
    const {loading, profile} = this.props.profile;
    const { errors,updateProfile } = this.state;
    var {divisions,districts} = this.props.place;
    
    let dashboardContent;
    let socialInputs;

    if(profile === null || loading){
      dashboardContent = <Spinner />
    }else{
      if(Object.keys(profile).length > 0){
        dashboardContent = 
        <div>
          <h4>Name: {user.name}</h4>
          <hr />
          <p>Division: {this.state.division}</p>
          <p>District: {this.state.district}</p>
          <p>city: {this.state.city}</p>
          <p>street: {this.state.street}</p>
          <p>address: {this.state.address}</p>
        </div>
      }else{
        dashboardContent = <h4>Full Name: {user.name}</h4>
      }
    }

    if(updateProfile){
      socialInputs = (<form onSubmit={this.onSubmit}>
        {divisions.length > 0 ? 
        <SelectListGroup 
        label="Division"
        placeholder="Division"
        name="division" 
        value={this.state.division}
        onChange={this.onChange}
        options={divisions}
        error={errors.division ? errors.division[0]: null}
        
        /> : null}
        {districts.length > 0 ? 
        <SelectListGroup 
        label="District"
        placeholder="District"
        name="district" 
        value={this.state.district}
        onChange={this.onChange}
        options={districts}
        error={errors.district ? errors.district[0]: null}

        /> : null}
        <TextFieldGroup 
        label="City"
        placeholder="City"
        name="city" 
        type="text" 
        value={this.state.city}
        onChange={this.onChange}
        error={errors.city ? errors.city[0]: null}

        />
        <TextFieldGroup 
        label="Street"
        placeholder="Street"
        name="street" 
        type="text" 
        value={this.state.street}
        onChange={this.onChange}
        error={errors.street ? errors.street[0]: null}
        />
        <TextFieldGroup 
        label="Full Address"
        placeholder="Full Address"
        name="address" 
        type="text" 
        value={this.state.address}
        onChange={this.onChange}
        error={errors.address ? errors.address[0]: null}
        info="Your full address so that we can ship your product at your door."
        />
        

        <input type="submit" value="Save" className="btn btn-outline-success" />
      </form>)
    }

    return (
      <Fragment>
      <div className="container mt-5">
        <div className="row">
          <div className="col-md-6 text-center">
          </div>
          <div className="col-md-6"></div>
        </div>
        <div className="row">
          <div className="col-md-6">
            <div className="card">
              <div className="card-body">
                { dashboardContent  }
              </div>
            </div>
          </div>
          <div className="col-md-6">
            <button className="btn btn-outline-success" onClick={ () => {
              this.setState(prevState => ({
                updateProfile: !prevState.updateProfile
              }))
            }}>Update Profile</button>  
            {this.state.updateProfile ? this.state.updateProfile: null}
            {socialInputs}
          </div>
        </div>
      </div>
      </Fragment>
    );
  }
}
Profile.propTypes = {
  getProfile: PropTypes.func.isRequired,
  getCategories: PropTypes.func.isRequired,
  getDivisions: PropTypes.func.isRequired,
  auth: PropTypes.object.isRequired,
  profile: PropTypes.object.isRequired,
  place: PropTypes.object.isRequired,
  errors:PropTypes.object.isRequired
}
const mapStateToProps = (state) => ({
  auth: state.auth,
  profile: state.profile,
  category: state.category,
  errors: state.errors,
  place: state.place
})
export default connect(mapStateToProps, {getProfile,updateProfile,getCategories,getDivisions,getDistricts})(Profile);
