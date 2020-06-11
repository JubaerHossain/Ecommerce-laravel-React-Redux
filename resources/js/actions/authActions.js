import axios from 'axios';
import setAuthToken from '../utils/setAuthToken';
import jwt_decode from 'jwt-decode';
import {GET_ERRORS, SET_CURRENT_USER} from './types';

export const registerUser  = (newUser, history) => dispatch => {
    axios.post('api/register', newUser)
    .then(res => history.push('/sign-in'))
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
        );
}
export const userDpid  = (userID) => dispatch => {
    axios.post('/api/set-user-id', userID)
    .then(res => 
        dispatch({
            type: SET_CURRENT_USER,
            payload: res.data
        })
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
        );
}

export const loginUser = (userData) => dispatch => {
    axios.post('api/login', userData)
    .then(res => {
        //save To Localstorage
        const { token, user } = res.data;
        // Set Token to LS
        localStorage.setItem('jwtToken', token);
        localStorage.setItem('jwtUser', JSON.stringify(user));
        // Set token to Auth header
        setAuthToken(token);
        // Decode token to get user 
        const decoded = jwt_decode(token);
        // Set current user
        dispatch(setCurrentUser(user));
    })
    .catch(err =>
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    );
}

export const setCurrentUser = (decoded) =>{
    return {
        type: SET_CURRENT_USER,
        payload: decoded
    }
}

// Log User out
export const logoutUser = () => dispatch => {
    
    axios.get('api/delete-storage');    
    localStorage.removeItem('jwtToken');
    localStorage.removeItem('jwtUser');
    // Remove auth header for future request
    setAuthToken(false);
    // Set current user to {} which eill set isAuthenticated to false
    dispatch(setCurrentUser({}));


}