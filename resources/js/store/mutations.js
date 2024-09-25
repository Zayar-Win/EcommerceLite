export default{
    setIsCartOpen(state,payload){
        state.isCartOpen= payload
    },
    addItemToCart(state,payload) {
        state.cartItems = [...state.cartItems,payload];
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
        localStorage.setItem('p&p-store',state.cartItems)
    }
}