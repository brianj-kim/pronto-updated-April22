import { useEffect, useRef, useState } from 'react';
import Banner from './components/Banner';
import Carousel from './components/Carousel';
import Footer from './components/Footer';

import Header from './components/Header';
import Categories from './components/Categories';
import Contents from './components/Contents';
import SearchMenu from './components/SearchMenu';

export default function App() {
  
  const [showHours, setShowHours] = useState(true);
  const [activeCategory, setActiveCategory] = useState(null);
  const [data, setData] = useState([]);
  const [originalData, setOriginalData] = useState([]);

  const targetCategoryPositions = [];
  
  const fetchJSON = async () => {
    await fetch('http://gopronto.ca/data/', {
            method: 'GET'            
          })
          .then((res) => res.json())
          .then((data) => {
            setData(data);
            setOriginalData(data);
          })
          .catch((err) => console.error('Error', err));
  }

  useEffect(() => {
    fetchJSON();
  }, [])

  const handleShowHours = () => {
    setShowHours(!showHours);

    if(showHours) {
      hoursRef.current.classList.remove("hidden");
    } else {
      hoursRef.current.classList.add("hidden");
    }
  }

  const hoursRef = useRef(null);

  // eslint-disable-next-line no-undef
  // console.log('showHours', showHours);
  // console.log(targetCategoryPositions);

  // console.log(data)

  return (
    <div className="w-full">       
      <Header showHours={showHours} handleShowHours={handleShowHours}/>
      <Banner ref={hoursRef} handleShowHours={handleShowHours}/>
      <Carousel />
      <Categories data={data} activeCategory={activeCategory} targetCategoryPositions={targetCategoryPositions}/>
      <SearchMenu
        originalData={originalData}
        setData={setData}
      />
      <Contents data={data} activeCategory={activeCategory} setActiveCategory={setActiveCategory} targetCategoryPositions={targetCategoryPositions} />
      <Footer />      
    </div>
    
  );
}
