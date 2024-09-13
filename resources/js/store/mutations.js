export default{
    setIsCartOpen(state,payload){
        state.isCartOpen= payload
    },
    addItemToCart(state,payload) {
        state.cartItems = [...state.cartItems,payload];
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
    },
    deleteItemFromCart(state,payload){
        state.cartItems = state.cartItems.filter((item,i) => i !== payload)
    },
    clearAllItemsFromCart(state){
        state.cartItems = []
    }
}