import {GET_PROFILE, PROFILE_LOADING, CLEAR_PROFILE,GET_DASHBOARD,GET_DM,GET_TRANSFERS,GET_CENTRAL} from '../actions/types';

const initialState = {
    profile:{},
    shipping:{},
    billing:{},
    dashboard:{},
    affiliators:[],
    transfers:[],
    central:[],
    
    loading:false
}
export default function(state = initialState, action){
    switch(action.type){
        case PROFILE_LOADING:
        return {
            ...state,
            loading:true
        }
        case GET_PROFILE:
        return {
            ...state,
            profile:action.payload,
            loading: false
        }
        case GET_DASHBOARD:
        return {
            ...state,
            dashboard:action.payload,
            loading: false
        }
        case GET_DM:
        return {
            ...state,
            affiliators:action.payload,
            loading: false
        }
        case GET_TRANSFERS:
        return {
            ...state,
            transfers:action.payload,
            loading: false
        }
        case GET_CENTRAL:
        return {
            ...state,
            central:action.payload,
            loading: false
        }
        case CLEAR_PROFILE:
        return {
            ...state,
            profile:null,
        }
        default:
            return state;
    }
}