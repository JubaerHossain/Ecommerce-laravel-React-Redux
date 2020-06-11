import {ADD_CART_PRODUCT, RESTORE_CART, DELETE_CART_PRODUCT, ADD_CART_PRODUCT_QTY,MINUS_CART_PRODUCT_QTY, CART_MESSAGE} from '../actions/types';
const initialState = {
    items: [],
    price: 0
}

export default function(state = initialState, action){
    switch(action.type){
        case ADD_CART_PRODUCT:
        let existed_item = state.items.find(item=> item.variation_id === action.payload.variation_id)
        if(existed_item){
            let totPrice = 0;
            const items = state.items.map(item => {
                if(item.variation_id === action.payload.variation_id){
                    totPrice += action.payload.price * action.payload.qty; 
                    return item = action.payload
                }else{
                    totPrice += item.price * item.qty;
                    return item
                }
            })
            const updatedItems = {
                ...state,
                items: [...items],
                price: totPrice
            }
            localStorage.setItem('cart', JSON.stringify(updatedItems));
            return updatedItems
        }else{
            const insertItems =  {
                ...state,
                items: [...state.items, action.payload],
                price: state.price + action.payload.qty * action.payload.price
            }
            localStorage.setItem('cart', JSON.stringify(insertItems));
            return insertItems
        }
        case RESTORE_CART:
            return action.payload
        case DELETE_CART_PRODUCT:
            const deletedItem = state.items.filter(item => item.variation_id != action.payload)
            const priceAfterDel = deletedItem.map(item => item.qty * item.price)
            const deleteItem = {
                ...state,
                items: [...deletedItem],
                price: priceAfterDel.reduce((a, b) => a + b , 0)
            }
            localStorage.setItem('cart', JSON.stringify(deleteItem));
            return deleteItem
        case ADD_CART_PRODUCT_QTY:
            const items = state.items.map(item => {
                    if(item.variation_id == action.payload){
                        item.qty = item.qty + 1
                        return item
                    }else {
                        return item
                    }
                })
            const price = items.map(item => item.qty * item.price)
            const allItems = {
                ...state,
                items: [...items],
                price: price.reduce((a, b) => a + b , 0)
            }
            localStorage.setItem('cart', JSON.stringify(allItems));
            return allItems
        case MINUS_CART_PRODUCT_QTY:
            const toMinusItems = state.items.map(item => {
                    if(item.variation_id == action.payload && item.qty > 1){
                        item.qty = item.qty - 1 
                        return item
                    }else {
                        return item
                    }
                })
                console.log(toMinusItems)
            const priceAfterMin = toMinusItems.map(item => item.qty * item.price)
            const allItemsAfter = {
                ...state,
                items: [...toMinusItems],
                price: priceAfterMin.reduce((a, b) => a + b , 0)
            }
            localStorage.setItem('cart', JSON.stringify(allItemsAfter));
            return allItemsAfter
        default:
            return state 
    }    
}