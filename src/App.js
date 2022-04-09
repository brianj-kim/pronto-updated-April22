import { useRef, useState } from 'react';
import Banner from './components/Banner';
import Carousel from './components/Carousel';
import Footer from './components/Footer';

import Header from './components/Header';
import Categories from './components/Categories';
import Contents from './components/Contents';
import data from './menus.json';
import SideCart from './components/SideCart';

export default function App() {
  
  const [isOpen, setIsOpen] = useState(false);
  const [cartItems, setCartItems] = useState(0);
  const [showHours, setShowHours] = useState(true);
  const [activeCategory, setActiveCategory] = useState(null);
  const targetCategoryPositions = [];

  const handleIsOpen = () => {
    setIsOpen(!isOpen);
  }

  const handleShowHours = () => {
    setShowHours(!showHours);

    if(showHours) {
      hoursRef.current.classList.remove("hidden");
    } else {
      hoursRef.current.classList.add("hidden");
    }
  }

  const hoursRef = useRef(null);

  // console.log('showHours', showHours);

  // console.log(targetCategoryPositions);
  
  return (

      <div className="mx-auto ">
        <SideCart isOpen={isOpen} setIsOpen={setIsOpen} cartItems={cartItems}/>    
        <Header showHours={showHours} handleShowHours={handleShowHours} handleIsOpen={handleIsOpen} cartItems={cartItems}/>
        <Banner ref={hoursRef} handleShowHours={handleShowHours}/>
        <Carousel />
        <Categories data={data} activeCategory={activeCategory} targetCategoryPositions={targetCategoryPositions}/>
        <Contents data={data} activeCategory={activeCategory} setActiveCategory={setActiveCategory} targetCategoryPositions={targetCategoryPositions} setCartItems={setCartItems}/>
        <Footer />      
      </div>
    
  );
}
