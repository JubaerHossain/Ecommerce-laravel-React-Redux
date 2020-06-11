import axios from 'axios';
import {GET_PROFILE, PROFILE_LOADING, CLEAR_PROFILE, GET_ERRORS,CLEAR_ERRORS,GET_DASHBOARD,GET_DM,GET_TRANSFERS,GET_CENTRAL} from './types';

export const getProfile  = () => dispatch => {
    dispatch(setProfileLoading());
    axios.get('api/get-profile')
    .then(res => {
        dispatch({
            type: GET_PROFILE,
            payload: res.data
        })
    })
    .catch(err => 
        dispatch({
            type: GET_PROFILE,
            payload: {}
        })
    );
}
export const updateProfile  = (profileData) => dispatch => {
    dispatch(clearErrors());
    axios.post('api/update-profile', profileData)
    .then(res => 
        dispatch({
            type: GET_PROFILE,
            payload: res.data
        })
    )
    .catch(err => {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    }
    );
}
export const changeCentral  = (centralData) => dispatch => {
    dispatch(clearErrors());
    
    axios.post('api/update-storage', centralData)
    .then(res => 
        dispatch({
            type: GET_CENTRAL,
            payload: res.data
        })
    )
    .catch(err => {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.error
        })
    }
    );
}
export const getDashboard  = () => dispatch => {
    dispatch(clearErrors());
    axios.get('api/get-dashboard')
    .then(res => {
        dispatch({
            type: GET_DASHBOARD,
            payload: res.data
        })}
    )
    .catch(err => {
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data
        })
    }
    );
}
export const userDm  = () => dispatch => {
    axios.get('/api/get-dm')
    .then(res => 
        dispatch({
            type: GET_DM,
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
export const transferAmmount  = () => dispatch => {
    axios.get('/api/transfer')
    .then(res => 
        dispatch({
            type: GET_DASHBOARD,
            payload: res.data
        })
    )
    .catch(err => 
        dispatch({
            type: GET_ERRORS,
            payload: err.response.data.warning
        })
        );
}
export const allTransfers  = () => dispatch => {
    axios.get('/api/getTransfer')
    .then(res => 
        dispatch({
            type: GET_TRANSFERS,
            payload: res.data
        })
    )
    .catch(err => 
        dispatch({
            type: GET_TRANSFERS,
            payload: {}
        })
        );
}
export const setProfileLoading =() =>{
    return {
        type: PROFILE_LOADING,
    }
}
export const clearProfile =() =>{
    return {
        type: CLEAR_PROFILE,
    }
}
// Clear errors
export const clearErrors = () => {
    return {
      type: CLEAR_ERRORS
    };
  };