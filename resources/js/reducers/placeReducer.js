import {GET_DIVISION,GET_DISTRICT,PLACE_LOADING} from '../actions/types';

const initialState = {
    divisions: {},
    districts: {},
    loading:false
}
export default function(state = initialState, action){
    switch(action.type){
        case PLACE_LOADING:
        return {
            ...state,
            loading:true
        }
        case GET_DIVISION:
        return {
            ...state,
            divisions:action.payload,
            loading: false
        }
        case GET_DISTRICT:
        return {
            ...state,
            districts:action.payload,
            loading: false
        }
        default:
            return state;
    }
}