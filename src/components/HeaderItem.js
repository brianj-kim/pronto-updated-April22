import React from 'react'

export default function HeaderItem({ Icon, title, props, cartItems }) {
  return (

      <div 
          className="flex flex-col items-center cursor-pointer group w-12 sm:w-20 hover:text-white"
          onClick={props}
      >

        { title === 'CART' ? (
            <div className="relative">
              <Icon className="h-7 group-hover:animate-bounce" />     
              <div className="absolute top-0 right-[-4px] w-4 h-4 bg-red-500 text-xs leading-4 font-semibold text-center rounded-full z-2">
                {cartItems ? `${cartItems}` : 0 }
              </div>
            </div>           
          ) : (
            <Icon className="h-7 group-hover:animate-bounce" />            
          )}
          <p className="opacity-0 group-hover:opacity-100 text-xs tracking-widest" >{title}</p>
          
      </div>
      
    
  )
}
