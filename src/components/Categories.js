import React, { useRef } from 'react';

export default function Menus({ data, activeCategory, targetCategoryPositions }) {

  const navCatRefs = useRef([]);
  navCatRefs.current = [];

  const assignNavCatRef = rf => {
    if(rf && !navCatRefs.current.includes(rf)) {
      navCatRefs.current.push(rf);
    }
  }

  const handleNavCategory = activeCat => {
    // console.log(activeCategory, activeCat);
    //  console.log(getCategoryPosition(activeCat));

    window.scrollTo({
      top: getCategoryPosition(activeCat) - 57,
      left: 0
    });

  
  }

  const getCategoryPosition = activeCat => {
    let tmp;

    targetCategoryPositions.map((tc) => {
      if(tc.category === activeCat) {
        tmp = tc.position;
      }
      return tc;
    });

    return tmp;
  }

  // console.log(targetCategoryPositions);

  return (
    <nav className="bg-[#17252A] sticky top-0">
        <div id="categoryMenu" className="flex px-12 sm:px-20 whitespace-nowrap space-x-14 sm:space-x-10 overflow-x-scroll scrollbar-hide h-fit">
        {data && data.map((categories, i) => (
            <div 
                key={i} 
                className={`text-xl py-3 last:pr-24 cursor-pointer transition duration-100 transform font-semibold text-white hover:scale-125 active:text-red-600 ${activeCategory === categories.category ? "scale-125 px-9 " : ""}`}
                ref={assignNavCatRef}
                onClick={() => handleNavCategory(categories.category)}
            >
                {categories.category}
            </div>
        ))}
        </div>
    </nav>
  )
}
