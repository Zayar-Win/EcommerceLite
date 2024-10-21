export default{
    setIsCartOpen(state,payload){
        state.isCartOpen= payload
    },
    addItemToCart(state,payload) {
        if(state.cartItems.find(cartItem => cartItem.product.product_detail.id == payload.product.product_detail.id)){
            state.cartItems = state.cartItems.map(cartItem => {
                if(cartItem.product.product_detail.id == payload.product.product_detail.id){
                    cartItem.product.quantity += payload.product.quantity
                }
                return cartItem
            })
        }else{
            state.cartItems = [...state.cartItems,payload];
        }
        localStorage.setItem('p&p-cart',JSON.stringify(state.cartItems))
    },
    updateCartItem(state,payload) {
        let {index,quantity} = payload;
        let newItems = state.cartItems?.map((item,i) => {
            if(i == index){
                item.product.quantity = quantity;
                return item;
            }else{
                return item;
            }
        })
        state.cartItems = newItems
        localStorage.setItem('p&p-cart',JSON.stringify(state.cartItems))
    },
    deleteItemFromCart(state,payload){
        state.cartItems = state.cartItems.filter((item,i) => i !== payload)
        localStorage.setItem('p&p-cart',state.cartItems)
    },
    clearAllItemsFromCart(state){
        state.cartItems = []
        localStorage.removeItem('p&p-cart')
    }
}