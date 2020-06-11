import React, { Component, Fragment } from "react";
import PropTypes from 'prop-types';
import {connect} from 'react-redux';
import {loginUser} from '../../actions/authActions';
import TextFieldGroup from '../common/TextFieldGroup';

class Login extends Component {
    constructor() {
        super();
        this.state = {
            email: "",
            password: "",
            errors: {}
        };
        this.onChange = this.onChange.bind(this);
        this.onSubmit = this.onSubmit.bind(this);
    }
    componentDidMount(){
        if(this.props.auth){
            if(this.props.auth.isAuthenticated){
                if(nextProps.auth.user.role.trim().split(',').includes('affiliator')){
                    this.props.history.push('/dashboard');
                }else{
                    this.props.history.push('/profile');
                }
            }
        }
    }
    componentWillReceiveProps(nextProps){
        if(nextProps.auth.isAuthenticated){
            if(nextProps.auth.user.role.trim().split(',').includes('affiliator')){
                this.props.history.push('/dashboard');
            }else{
                this.props.history.push('/profile');
            }
        }
        if(nextProps.errors){
            this.setState({errors: nextProps.errors})
        }
    }
    onChange(e) {
        this.setState({ [e.target.name]: e.target.value });
    }
    onSubmit(e) {
        e.preventDefault();
        const userData = {
            email: this.state.email,
            password: this.state.password
        };
        this.props.loginUser(userData);
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
                                    label="Email Address"
                                    placeholder="Email Address"
                                    name="email" 
                                    type="text" 
                                    value={this.state.email}
                                    onChange={this.onChange}
                                    error={errors.email ? errors.email[0]: null}
                                    />
                                    <TextFieldGroup 
                                    placeholder="Password"
                                    placeholder="Password"
                                    name="password" 
                                    type="password" 
                                    value={this.state.password}
                                    onChange={this.onChange}
                                    error={ errors.password ? errors.password[0] : null }
                                    />
                                    <button
                                        type="submit"
                                        className="btn btn-outline-success btn-block"
                                    >
                                        LOG IN
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
Login.propTypes = {
    loginUser: PropTypes.func.isRequired,
    auth: PropTypes.object.isRequired,
    errors: PropTypes.object.isRequired
}
const mapStateToProps = (state) => ({
    auth: state.auth,
    errors: state.errors
})

export default connect(mapStateToProps, {loginUser})(Login);
