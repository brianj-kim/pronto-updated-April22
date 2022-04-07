import React from 'react'

export default function HeaderItem({ Icon, title, props }) {
  return (
    <div 
        className="flex flex-col items-center cursor-pointer group w-12 sm:w-20 hover:text-white"
        onClick={props}
    >
        <Icon className="h-7 group-hover:animate-bounce" />
        <p className="opacity-0 group-hover:opacity-100 text-xs tracking-widest" >{title}</p>
    </div>
  )
}
