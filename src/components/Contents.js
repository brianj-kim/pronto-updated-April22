import React, { useRef, useLayoutEffect } from 'react';
import MenuCard from './MenuCard';

export default function Contents({ data, activeCategory, setActiveCategory, targetCategoryPositions }) {
  // console.log(props);

    const targetRefs = useRef([]);
    targetRefs.current = [];


    const handleScroll = () => {
        const position = window.pageYOffset + 57;
        
        // console.log(position);
        targetRefs.current.map(dv => {
            // console.log(dv.offsetTop, dv.firstChild.childNodes[0].innerText);
            if(position > dv.offsetTop && position < (dv.offsetTop + dv.offsetHeight)) {
                if(activeCategory !== dv.firstChild.childNodes[0].innerText) {
                    // console.log(dv.firstChild.childNodes[0].innerText);
                    setActiveCategory(dv.firstChild.childNodes[0].innerText);                    
                }                                
            }
            return dv;

        });
    }


    const setTargetCategoryPosition = () => {
        const target = targetRefs.current;

        target.map((dv) => {
            return targetCategoryPositions.push({ 
                "category": dv.firstChild.childNodes[0].innerText,
                "position": dv.offsetTop 
            });
        });
    }

    useLayoutEffect(() => {
        window.addEventListener('scroll', handleScroll, { passive: true });
        setTargetCategoryPosition();
        handleCategoryNav();
        // console.log(activeCategory);
        return () => {
            window.removeEventListener('scroll', handleScroll);
        }
    });


    // Assigning useRef hooks on each category item.
    const handleTargetRefs = rf => {
        if(rf && !targetRefs.current.includes(rf)) {
            targetRefs.current.push(rf);
        }
    }
    
  // console.log(targetRefs.current);
  const handleCategoryNav = () => {
    // console.log(activeCategory, document.querySelector("#targetScroll").firstChild.childNodes[0].innerText);
    const target = document.querySelector("#categoryMenu");
    // console.log(target);

    target.childNodes.forEach((tc) => {
        if(activeCategory === tc.innerText) {
            // console.log(tc.offsetLeft);
            target.scrollLeft = tc.offsetLeft;
        }
        // console.log(tc.innerText);
    });
    
  }

  return (

    <div className="w-full flex bg-[#FEFFFF] min-h-screen text-teal-header px-6 md:px-14 py-2">
        <div id="targetScroll" className="flex flex-auto flex-col justify-center mt-4">
        { data && data.map((item, i) => (
            <div key={i} ref={handleTargetRefs} className="rounded-t-lg rounded-b-lg mb-8 h-fit">
                <div className="flex flex-col justify-center text-center py-3 rounded-t-md bg-[#abd9cb]">
                    <p className="text-xl font-semibold">{item.title}</p>
                    { item.details!== "" ? 
                        <p className="text-sm opacity-60">{item.details}</p> : null
                    }                    
                </div>
                <div className={`py-3 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4`}>
                { item.menus && item.menus.map((menu,i) => 
                    menu.isOnSale ? (
                        <MenuCard menu={menu} key={i} />
                    ) : null )}
                </div>
            </div>                
        ))}
        </div>  
    </div>   

  )
}
