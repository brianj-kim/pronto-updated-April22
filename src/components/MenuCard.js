import React from 'react';
import { FaLeaf, FaPepperHot } from "react-icons/fa";

export default function MenuCard({ menu }) {
  return (
    <div className="rounded-lg flex hover:bg-[#f0f8f8] hover:shadow-md border border-gray-200 rounded-md">        
    {menu.image !== '' ? (
      <div 
          className="min-w-[140px] min-h-[130px] max-h-full bg-cover bg-center rounded-l-md"
          style={{ backgroundImage: `url("http://gopronto.ca${menu.image}")`}}
      ></div>
    ): (
      <div className="min-w-[140px] min-h-[130px] max-h-full flex items-center justify-center text-center text-sm text-gray-600 bg-gray-200 rounded-l-md">
          image <br/>
          not ready
      </div>
    )}

      
      <div className="w-full flex flex-col justify-start"> 
        <div>
          <div className="text-lg text-teal-800 font-semibold mt-1 ml-3">{menu.title}</div>
          {menu.details && (<div className="text-sm text-gray-500 ml-3">{menu.details}</div>)}       
        </div>
        <div className="mt-2 text-lg mb-2 ml-3 text-teal-800">${menu.price}</div>
        <div className="w-full mb-2 flex items-center justify-start"> 
          {menu.isSpicy ? (<div className="ml-3 px-3 py-1 font-semibold rounded-md border border-red-600 text-red-600 uppercase text-xs flex justify-center items-center">spicy <FaPepperHot className="ml-1"/></div>) : null}
          {menu.isVeggie ? (<div className="ml-3 px-3 py-1 uppercase font-semibold border border-lime-600 rounded-md text-lime-600 text-xs flex items-center justify-center">vegan <FaLeaf className="ml-1" /> </div>) : null}
        </div>         
       
        <div
          className="w-full h-full flex justify-end items-end pr-2 pb-2"
        >
          <button 
            className="w-[30px] h-[30px] rounded-full border border-gray-300 shadow-sm"
          >
            +
          </button>
        </div>
      </div>
            
    </div>
  )
}
