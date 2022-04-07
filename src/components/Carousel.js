import React from 'react';
import { Carousel } from 'react-carousel-minimal';

import ganjangChicken from '../img/korean_style_ganjang_chicken.jpg';
import jumboRainbow from '../img/jumbo_rainbow.jpg';
import nagasakiRamen from '../img/ramen_nagasaki.jpg';
import nigiriRoll from '../img/roll_nigiri.jpg';
import toriKaraake from '../img/tori_karaake.jpg';
import spinachSalad from '../img/spinach_salad.jpg';
import sakuraRoll from '../img/roll_sakura.jpg';
import sushiRoll from '../img/sushi_roll.jpg';


export default function Casoursel() {
    const data = [
        { 
            image: jumboRainbow,
            caption: "Jumbo Rainbow Roll"
        },
        { 
            image: ganjangChicken,
            caption: "Ganjang Chichen"
        },        
        { 
            image: nagasakiRamen,
            caption: "Nagasaki Ramen"
        },
        { 
            image: nigiriRoll,
            caption: "Nigiri Roll"
        },
        { 
            image: toriKaraake,
            caption: "Tori Kara-Ake"
        },
        { 
            image: spinachSalad,
            caption: "Spinach Salad"
        },
        { 
            image: sakuraRoll,
            caption: "Sakura Roll"
        },
        { 
            image: sushiRoll,
            caption: "Sushi Roll"
        }
    ]

    const captionStyle = {
        fontSize: '2em',
        fontWeight: 'bold',
      }
      const slideNumberStyle = {
        fontSize: '20px',
        fontWeight: 'bold',
      }
      return (
        <div className="w-full bg-white">
          <div style={{ textAlign: "center" }}>
            <div style={{
              padding: "0"
            }}>
              <Carousel
                data={data}
                time={3500}
                width="100%"
                height="280px"
                captionStyle={captionStyle}
                radius="0"
                slideNumber={false}
                slideNumberStyle={slideNumberStyle}
                captionPosition="bottom"
                automatic={true}
                dots={true}
                pauseIconColor="white"
                pauseIconSize="40px"
                slideBackgroundColor="darkgrey"
                slideImageFit="cover"
                thumbnails={false}
                thumbnailWidth="100px"
                style={{
                  textAlign: "center"
                }}
              />
            </div>
          </div>
        </div>
      );

}