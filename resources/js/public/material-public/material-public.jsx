import React from "react";
import { createRoot } from "react-dom/client";
import "./App.css";
import App from "./booking-process/App"
import Filter from "./tour-filter/Filter"


if (document.getElementById("booking-tour")) {
    const tour_slug= document.getElementById("booking-tour").getAttribute("tour_slug");
    const group_slug= document.getElementById("booking-tour").getAttribute("group_slug");
    createRoot(document.getElementById("booking-tour")).render(<App tour_slug={tour_slug} group_slug={group_slug}/>)
}


if (document.getElementById("tour_filter")) {
    createRoot(document.getElementById("tour_filter")).render(<Filter listing={JSON.parse(document.getElementById("tour-list-data").textContent)}/>)
}





