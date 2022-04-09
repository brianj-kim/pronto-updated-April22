import React from 'react'

export default function SideCart({isOpen, setIsOpen, cartItems}) {
  

  return (
        <div 
            className={`top-0 right-0 fixed w-3/4 sm:w-3/5 lg:w-2/5 p-5 bg-white h-full z-10 shadow-md cursor-pointer ${isOpen ? 'translate-x-0' : 'translate-x-full'} ease-in-out duration-300 `}
            onClick={() => setIsOpen(false)}
        >
            SideCart - {cartItems}
        </div>
  )
}

