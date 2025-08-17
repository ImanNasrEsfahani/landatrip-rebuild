import { createTheme } from "@mui/material";



const customTheme  = createTheme({
    palette : {
      primary: {
        main: "#007560",
        tint1: "#80BAAF",
        tint2: "#BFDDD7",
        tint3: "#F2F8F7",
        tone1: "#005E4D",
        tone2: "#003A30",
        tone3: "#001D18",
      },
      secondary: {
        main: "#FF8C00",
        tint1: "#FFC57F",
        tint2: "#FFE2BF",
        tint3: "#FFF9F2",
        tone1: "#CC7000",
        tone2: "#804600",
        tone3: "#402300",
      },
      tertiary: {
        main: "#272A3A",
        tint1: "#92949C",
        tint2: "#C9C9CD",
        tint3: "#F4F4F5",
        tone1: "#1F222E",
        tone2: "#13151D",
        tone3: "#0A0A0E",
       
      },
      gray: {
        main: "#C8CCCB",
        tint1: "#E3E5E4",
        tint2: "#F1F2F2",
        tint3: "#F7F8F7",
        tone1: "#A0A3A2",
        tone2: "#646665",
        tone3: "#323333",
      },
      error: {
        main: "#DC3545",
        bg : "#FEF7F8"
      },
      success: {
        main: "#28A745",
        bg : "#F7FCF8"
      },
      warning: {
        main: "#FFC107",
        bg : "#FFFDF5"
      },
        white: "#ffffff",
        black : "#000000",

        chat: "#fafafa",
        inputs: "#EAEEF3",
        sidebarTitle : "#4B77C6",
        button : "#007560",
        stoppingPoint : "#919191",
        textSpan : "#5E6470",
        boxColor : "#F2F5FA",
        discount : "#025946",
        discountBack : "#E3F8FF",
        step : "#272A3A",
        star : "#FF8C00",
        bgRating : "#FFE2BF"
    },
    typography: {
        fontFamily: "Quicksand-VariableFont_wght",
        display1:{
          fontFamily: "EB Garamond",
          fontSize: "64px",
          fontStyle: "normal",
          fontWeight: "400",
          lineHeight: "140%",
        },
        h1: {
            fontFamily: "Marmelad",
            fontSize: "50px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "100px",
        },
        h2: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "40px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "60px",
        },
        h2Semibold:{
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "40px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "60px",
        },
        H2Bold:{
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "40px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "60px",
        },
        h3: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "33px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "49px",
        },
        h3Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "33px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "49px",
        },
        h3Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "33px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "49px",
        },
        h4: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "28px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "42px",
        },
        H4Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "28px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "42px",
        }, 
        h4Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "28px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "42px",
        },
        h5: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "23px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "34px",
        },
        h5Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "23px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "34px",
        },
        h5Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "23px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "34px",
        },
        h6: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "19px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "28px",
        },
        h6Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "19px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "28px",
        },
        h6Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "19px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "28px",
        },
        body1: {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "11px",
          fontStyle: "normal",
          fontWeight: "400",
          lineHeight: "16px",
        },
        body1Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "11px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "16px",
        },
        body1Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "11px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "16px",
        },
        body2: {
            fontFamily: "EB Garamond",
            fontSize: "12px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "180%",
        },
        subtitle1: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "16px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "24px",
        },
        subtitle1Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "16px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "24px",
        },
        subtitle1Bold: {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "16px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "24px",
        },
        subtitle2: {
            fontFamily: "Quicksand-VariableFont_wght",
            fontSize: "13px",
            fontStyle: "normal",
            fontWeight: "400",
            lineHeight: "20px",
        },
        subtitle2Semibold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "13px",
          fontStyle: "normal",
          fontWeight: "600",
          lineHeight: "20px",
        },
        subtitle2Bold : {
          fontFamily: "Quicksand-VariableFont_wght",
          fontSize: "13px",
          fontStyle: "normal",
          fontWeight: "700",
          lineHeight: "20px",
        },
    },
  // components: {
  //       MuiTab: {
  //         styleOverrides: {
  //           root: {
  //             '&.Mui-selected': {
  //               boxShadow: "3px 3px 10px 1px rgba(0, 0, 0, 0.15)",
  //               color: 'black',
  //               borderRadius : "12px",

  //             },
  //           },
  //         },
  //       },
  //   },
});

export default customTheme;
