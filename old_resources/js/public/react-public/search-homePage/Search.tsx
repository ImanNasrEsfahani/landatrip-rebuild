import React, { useState } from 'react'
import dateIcon from '../images/icon-date.svg'
import skillIcon from '../images/icon-skill.svg'
import guestIcon from '../images/icon-guest.svg'

console.log("mohsen")

const Search = () => {

    const [inputValue, setInputValue] = useState('');
    const [options, setOptions] = useState([]);
    const [isListOpen, setIsListOpen] = useState(false);

    const handleInputBlur = () => {
      setIsListOpen(false);

    };


    const handleInputChange = (e) => {
      const value = e.target.value;
      setInputValue(value);

      if (value.trim() === '') {
        setIsListOpen(false);
        setOptions([]);
      } else {
        const filteredOptions = itemData.filter((film) =>
          film.title.toLowerCase().includes(value.toLowerCase())
        );
        setOptions(filteredOptions);
        setIsListOpen(true);
      }
    };


    const handleOptionClick = (e) => {
        const selectedValue = e.title;
        console.log("ssss",selectedValue)
        setInputValue(selectedValue);
        setOptions([]);
        setIsListOpen(false);
    };
    return(
      <div>
          <div className="join md:rounded-2xl shadow-inner shadow-white/40 w-full ">
              <div className="flex flex-col  md:flex-row  justify-center	backdrop-opacity-95 backdrop-blur w-full bg-white/30">
                  <div
                      className="flex flex-1 rounded-full join-item border-0 text-white focus:outline-none focus:outline-0 px-5 items-center">
                      <img src={dateIcon} alt="date"/>
                      <select
                          className="select my-select w-full  bg-transparent rounded-full join-item border-0 text-white focus:outline-none focus:outline-0">
                          <option disabled selected><span>Date</span></option>
                          <option className="text-black bg-[#AEAEAE]">Sci-fi</option>
                          <option className="text-black bg-[#AEAEAE]">Drama</option>
                          <option className="text-black bg-[#AEAEAE]">Action</option>
                      </select>
                  </div>


                  <div className="flex flex-1 items-center px-5 sm:px-0 mt-1 sm:mt-0">
                  <img src={skillIcon} alt="date"/>
                      <input
                          type="search"
                          className="my-input bg-transparent text-white placeholder-white w-full sm:w-20 md:w-48  rounded-md  px-4 focus:outline-none "
                          placeholder="Skill"
                          value={inputValue}
                          onChange={handleInputChange}

                      />

                  </div>


                  <div
                      className="flex flex-1 rounded-xl join-item border-0 text-white focus:outline-none focus:outline-0 px-5 items-center mt-1 sm:mt-0">
                      <img src={guestIcon} alt="guest"/>
                      <select
                          className="select  w-full  bg-transparent rounded-full join-item border-0 text-white focus:outline-none focus:outline-0">
                          <option disabled selected>
                              <span>Guests</span>
                          </option>
                          <option className="text-black bg-[#AEAEAE]">Sci-fi</option>
                          <option className="text-black bg-[#AEAEAE]">Drama</option>
                          <option className="text-black bg-[#AEAEAE]">Action</option>
                      </select>
                  </div>
                  <div className="indicator join-item  backdrop-blur-[90%] rounded-xl w-full md:w-auto pr-1">
                      <button className="btn border-0 mx-auto  backdrop-blur-[90%] rounded-2xl bg-white text-black capitalize m-1">Explore!</button>
                  </div>
              </div>
          </div>
          {isListOpen && options.length > 0 && (
              <ul onBlur={handleInputBlur} className="absolute p-2 left-[8%] top-[47%] sm:top-[100%] sm:left-[32%] w-[12rem] rounded-xl bg-[#AEAEAE]" >
                {options.map((option) => (
                    <li
                        key={option.img}
                        onClick={() => handleOptionClick(option)}
                        className="p-2 cursor-pointer hover:bg-blue-100"
                    >
                    {option.title}
                    </li>
                ))}
              </ul>
          )}
      </div>
    )
}

const itemData = [
    {
      img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
      title: 'salam',
    },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'kiani',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'mohsen',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'jafar',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'ali',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'god',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'tehran',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'isfahan',
      },
    {
        img: 'https://images.unsplash.com/photo-1551963831-b3b1ca40c98e',
        title: 'kako',
      },

  ];

export default Search;
