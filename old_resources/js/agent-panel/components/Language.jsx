import React from 'react';
import { US, FR, IR } from 'country-flag-icons/react/3x2';
import { useTranslation } from "react-i18next";
import {useEffect} from "react";
import "./Language.scss";

export default function Language(props) {
    const {i18n} = useTranslation();
    const lang = JSON.parse(props.lang);
    const currentLang = props.currentLang;

    const switchLangFlag = (slug) => {
        switch(slug) {
            case 'en':
                return <US title="United States" className="max-h-9drem"/>;
            case 'fr':
                return <FR title="French" className="max-h-9drem"/>;
            case 'fa':
                return <IR title="Iran" className="max-h-9drem"/>;
            default:
                return '';
        }
    }
    // useEffect(()=>{
    //         i18n.changeLanguage(currentLang)
    // },[])


    return (
        <div className="dropdown language mb-1 h-100 me-3">
            <button className="btn dropdown-toggle h-100 pe-4" type="button" id="langDropdownMenu" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                { switchLangFlag(lang.find(val => val.slug === currentLang)['slug'])}
            </button>
            <ul className="dropdown-menu dropdown-menu-end position-absolute language" aria-labelledby="langDropdownMenu">
                {
                    lang.map((item, index) => (
                        <li key={index}>
                            <a className="dropdown-item align-items-center" href={`${import.meta.env.VITE_APP_URL}/language/${item.slug}`}>
                                { switchLangFlag(item.slug)}
                                <span className="ms-3"> </span> {item.name}
                            </a>
                        </li>
                    ))
                }
            </ul>
        </div>
    );
}

