import { useRef, useState } from 'react';
import Banner from './components/Banner';
import Carousel from './components/Carousel';
import Footer from './components/Footer';

import Header from './components/Header';
import Categories from './components/Categories';
import Contents from './components/Contents';
import data from './menus.json';

export default function App() {
  
  const [showHours, setShowHours] = useState(true);
  const [activeCategory, setActiveCategory] = useState(null);
  const targetCategoryPositions = [];


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
    <div>       
      <Header showHours={showHours} handleShowHours={handleShowHours}/>
      <Banner ref={hoursRef} handleShowHours={handleShowHours}/>
      <Carousel />
      <Categories data={data} activeCategory={activeCategory} targetCategoryPositions={targetCategoryPositions}/>
      <Contents data={data} activeCategory={activeCategory} setActiveCategory={setActiveCategory} targetCategoryPositions={targetCategoryPositions} />
      <Footer />      
    </div>
    
  );
}
