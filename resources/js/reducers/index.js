import { combineReducers } from 'redux';
import authReducer from './authReducer';
import errorReducer from './errorReducer';
import ProductReducer from './productReducer';
import CategoryReducer from './categoryReducer';
import profileReducer from './profileReducer';
import placeReducer from './placeReducer';
import cartReducer from './cartReducer'
import storageReducer from './storageReducer'
import searchReducer from './searchReducer'
import catProductReducer from './catProductReducer'

export default combineReducers({
    auth: authReducer,
    errors: errorReducer,
    product: ProductReducer,
    discount_product: ProductReducer,
    category: CategoryReducer,
    procategory: CategoryReducer,
    profile: profileReducer,
    place: placeReducer,
    cart: cartReducer,
    marchant: storageReducer,
    search: searchReducer,
    cat_products: catProductReducer,
})