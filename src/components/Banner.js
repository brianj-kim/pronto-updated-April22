import React, { forwardRef } from 'react';

const Banner = (props, ref) => {
  return (
    <div ref={ref} className="w-full flex flex-col sm:flex-row justify-center py-2 banner-color-gradient">
        <div className="flex flex-row justify-center text-red-600 text-sm font-bold">
          <div className="flex flex-row">
            <div className="px-2 sm:px-4 font-semibold">
              Hours
            </div>
            <div className="flex flex-col px-4">
              <span className="font-semibold">M ~ F</span>
              <span className="font-semibold">Sat</span>
              <span className="font-semibold">Sun</span>
            </div>
          </div>
          <div className="flex flex-col text-left">
            <span className="font-semibold">- 11:00am ~ 7:30pm</span>
            <span className="font-semibold">- 11:30am ~ 7:00pm</span>
            <span className="font-semibold">- Close</span>
          </div>          
        </div>
        <div className="mt-2 sm:absolute sm:right-0 sm:mt-5 flex items-center justify-center sm:justify-start px-4">
          <button 
              className="bg-[#2B7A78] text-white font-semibold uppercase text-xs px-4 py-1 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
              onClick={() => props.handleShowHours()} 
          >
              Close
          </button>
        </div>           
      </div>
  )
}

export default forwardRef(Banner);
