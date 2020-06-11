import React, { Component, Fragment } from "react";
import PropTypes from 'prop-types';
import {withRouter} from 'react-router-dom';
import {connect} from 'react-redux';
import {registerUser} from '../../actions/authActions';
import TextFieldGroup from '../common/TextFieldGroup';


class Register extends Component {
    constructor() {
        super();
        this.state = {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            phone: "",
            role: "affiliator",
            errors: {}
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }
    componentDidMount(){
        if(this.props.auth.isAuthenticated){
            this.props.history.push('/profile');
        }
    }
    onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    componentWillReceiveProps(nextProps){
        if(nextProps.errors){
            this.setState({errors: nextProps.errors})
        }
    }
    onSubmit(e) {
        e.preventDefault();
        const newUser = {
            name: this.state.name,
            email: this.state.email,
            password: this.state.password,
            password_confirmation: this.state.password_confirmation,
            phone: this.state.phone,
            role: this.state.role
        };
        this.props.registerUser(newUser, this.props.history);
    }
    render() {
        const {errors} = this.state;        

        return (
            <Fragment>
                <div className="row">
                    <div className="col-md-6 offset-md-3">
                        <div className="card">
                            <img
                                src={require(`../../img/ecommerce.jpg`)}
                                className="card-img-top"
                            />
                            <div className="card-body">
                                <form onSubmit={this.onSubmit}>
                                    <TextFieldGroup 
                                    label="Full Name"
                                    placeholder="Full Name"
                                    name="name" 
                                    type="text" 
                                    value={this.state.name}
                                    onChange={this.onChange}
                                    error={errors.name ? errors.name[0]: null}
                                    />
                                    <TextFieldGroup 
                                    label="Email Address"
                                    placeholder="Email Address"
                                    name="email" 
                                    type="text" 
                                    value={this.state.email}
                                    onChange={this.onChange}
                                    error={errors.email ? errors.email[0]: null}
                                    />
                                    
                                    <div className="row">
                                        <div className="col-md-6">
                                            <TextFieldGroup 
                                            label="Password"
                                            placeholder="Password"
                                            name="password" 
                                            type="password" 
                                            value={this.state.password}
                                            onChange={this.onChange}
                                            error={errors.password ? errors.password[0]: null}
                                            />
                                        </div><div className="col-md-6">
                                            <TextFieldGroup 
                                            label="Password Confirmation"
                                            placeholder="Password Confirmation"
                                            name="password_confirmation" 
                                            type="password" 
                                            value={this.state.password_confirmation}
                                            onChange={this.onChange}
                                            error={errors.password_confirmation ? errors.password_confirmation[0]: null}
                                            />
                                        </div>
                                    </div>
                                    <div className="row">
                                        <div className="col-md-6">
                                            <TextFieldGroup 
                                            label="Phone"
                                            placeholder="Phone"
                                            name="phone" 
                                            type="text" 
                                            value={this.state.phone}
                                            onChange={this.onChange}
                                            error={errors.phone ? errors.phone[0]: null}
                                            />
                                        </div>
                                    </div>
                                    <button
                                        type="submit"
                                        className="btn btn-outline-success btn-block"
                                    >
                                        Register Now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </Fragment>
        );
    }
}
Register.propTypes = {
    registerUser: PropTypes.func.isRequired,
    auth: PropTypes.object.isRequired,
}
const mapStateToProps = state => ({
    auth: state.auth,
    errors: state.errors
})
export default connect(mapStateToProps, {registerUser})(withRouter(Register));
