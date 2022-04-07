import React from 'react'

export default function MenuCard({ menu }) {
  return (
    <div className="flex flex-col justify-between p-3 border-t border-solid border-blueGray-50 hover:bg-[#f0f8f8] ">
        <div className="flex flex-row justify-between">
            
            <div className="flex items-center">
            { menu.image && menu.image !== "" ? (
                <img src={menu.image} className="w-14 rounded-lg mr-3 shadow border border-solid border-slate-300" alt={"photo of" + menu.title}/>
            ) : null }
                <div className="flex flex-col text-left">
                    <div>{menu.id}. {menu.title}</div>
                    { menu.description && menu.description !== "" ? (
                    <div className="text-left text-xs text-slate-600">{menu.description}</div>
                    ) : null }
                </div>
            </div>
            
            <div className="text-sm">{new Intl.NumberFormat('en-CA', { style: 'currency', currency: 'CAD' }).format(menu.price)}</div>
        </div>    
    </div>
  )
}
