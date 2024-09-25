export default{
    isCartOpen : false,
    isSideNavOpen : false,
    cartItems : localStorage.getItem('p&p-cart') ? JSON.parse(localStorage.getItem('p&p-cart')) : []
}