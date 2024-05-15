import { useEffect, useRef, useState } from "react";

export default function SearchMenu ({
  originalData,
  setData
}) {
  // console.log(originalData);
  const searchRef = useRef(null);
  const [query, setQuery] = useState("");

  useEffect(() => {
    if(query === "") {
      setData(originalData);

    } else {
      const newData = originalData.map((c) => ({
        ...c,
        menus: c.menus.filter(m => m.title.toLowerCase().includes(query.toLowerCase()))
      }));

      setData(newData);

    }
  }, [originalData, query, setData]);

  return (
    <div
      className="w-full bg-white text-center px-6 md:px-14 pt-4"
    >
      <div>
        <input
          ref={searchRef}
          onChange={(e) => setQuery(e.target.value)}
          type="search"
          className="border border-[#abd9cb] rounded-md block w-full p-2.5 pl-3 placeholder-teal-600 text-teal-800 focus:outline-none"
          placeholder="Search Menus"
        />

      </div>
    </div>
  )
}