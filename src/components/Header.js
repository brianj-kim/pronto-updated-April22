import logo from '../img/logo_pronto.png';
import {
  PhoneIcon,
  LocationMarkerIcon,
  PencilAltIcon,
  ClockIcon,
  ShoppingCartIcon
} from '@heroicons/react/outline';
import HeaderItem from './HeaderItem';

export default function Header({ handleShowHours, handleIsOpen, cartItems }) {
  const handlePhoneCall = () => {
    // console.log("phone call handle function has been evoked");
    window.location.href = "tel://306-546-3278";
  }
  
  const handleLocation = () => {
   //  console.log("location handle function has been evoked");
    window.open("https://goo.gl/maps/ScRcq9m51LdJ6Fqg9", "_blank")
  }

  const handleOnlineOrder = () => {
    // console.log("Online order function has been evoked");
    window.location.href="https://smooth.menu/pronto-cafe/menu/";
  }


  return (
    <header className="flex flex-col sm:flex-row mx-5 mt-5 mb-2 justify-between items-center h-auto">
      <img src={logo} alt="site logo" width={180} className="object-contain mb-5" />
      <div className="flex flex-grow justify-evenly max-w-2xl">
        <HeaderItem title='CALL' Icon={PhoneIcon} props={handlePhoneCall}/>
        <HeaderItem title='LOCATION' Icon={LocationMarkerIcon} props={handleLocation} />      
        <HeaderItem title='HOURS' Icon={ClockIcon} props={handleShowHours}/>
        <HeaderItem title='ORDER' Icon={PencilAltIcon} props={handleOnlineOrder}/>
        <HeaderItem title='CART' Icon={ShoppingCartIcon} props={handleIsOpen} cartItems={cartItems}/>

      </div>
            
    </header>
  );
}
