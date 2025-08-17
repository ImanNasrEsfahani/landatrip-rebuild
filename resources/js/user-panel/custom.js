import { createTheme, colors } from "@mui/material";

const customTheme = createTheme({
    palette: {
        primary: {
            main: "#007560",
            10: "#E5FFFA",
            20: "#ABDED5",
            30: "#72BBAE",
            40: "#399887",
            50: "#007560",
            60: "#005F4E",
            70: "#00483B",
            80: "#003128",
            90: "#001A15",
            100:"#66B735"
        },
        orange: {
            main: "#FF8C00",
            10: "#FFF4E5",
            20: "#FFDAAB",
            30: "#FFC072",
            40: "#FFA639",
            50: "#FF8C00",
            60: "#C56E00",
            70: "#8C4E00",
            80: "#532E00",
            90: "#1A0E00",
        },
        gray: {
            main: "#6C757D",
            10: "#F1F2F3",
            20: "#CFD2D7",
            30: "#AEB3B9",
            40: "#8D949B",
            50: "#6C757D",
            60: "#545B62",
            70: "#3C4146",
            80: "#24272A",
            90: "#0C0D0E",
        },
        white: "#ffffff",
        chat: "#fafafa",
        inputs: "#EAEEF3",
        chatsub:"#cccccc"
        // "light-pale-green": "#EDF7F6",
        // "light-green": "#63A99D",
        // green: "#007560",
        // yellow: "#FFD454",
        // orange: "#FF8C00",
        // brown: "#D26800",
        // "light-blue": "#51B5D9",
        // "light-purpol": "#FE75B9",
        // "light-gray": "#EAEEF3",
        // gray: "#DDD",
        // "dark-gray": "#545454",
        // "blue-green": "#00696E",
        // "blue-green-dark": "#abd8da",
        // "blue-green-lighter": "#268084",
        // "blue-green-light": "#1C8B92",
        // "gray-light": "#297191",
        // "light-mustard": "#FED46C",
        // bittersweet: "#FB6666",
        // "basket-ball-orange": "#FD8753",
        // "deep-sea-green": "#134C64",
        // "medium-gray": "#D9D9D9",
        // "ironside-grey": "#666666",
        // sand: "#E6C56F",
        // "dark-red": "#AA1A1A",
        // "dark-green": "#15443C",
        // "kiwi-green": "#8CE56C",
        // "blue-koi": "#5A9BC0",
    },
    typography: {
        fontFamily: "Marmelad",
        h1: {
            fontSize: "70px",
            // lineHeight: "60",
            letterSpacing: "-1.5%",
        },
        h2: {
            fontSize: "58px",
            // lineHeight: "50",
            letterSpacing: "-0.5%",
        },
        h3: {
            fontSize: "47px",
            // lineHeight: "30",
            letterSpacing: 0,
        },
        h4: {
            fontSize: "25px",
            // lineHeight: "30",
            letterSpacing: "0%",
        },
        h5: {
            fontSize: "20px",
            // lineHeight: "20",
            letterSpacing: "0%",
        },
        h6: {
            fontSize: "14px",
            // lineHeight: "20",
            letterSpacing: "0.15%",
        },
        button: {
            fontSize: "15px",
            letterSpacing: "1.25%",
        },
        caption: {
            fontSize: "12px",
            letterSpacing: "0.4%",
        },
        body1: {
            fontSize: "17px",
            // lineHeight: "25",
            letterSpacing: "0.5%",
        },
        body2: {
            fontSize: "13px",
            // lineHeight: "24",
            letterSpacing: "0.25%",
        },
    },
    components: {
        MuiToolbar: {
            styleOverrides: {
                root: {
                    height: "55px",
                    minHeight: "60px",
                    "@media all": {
                        minHeight: 55,
                    },
                },
            },
        },
        MuiButton: {
            styleOverrides: {
                root: {
                    borderRadius: 50,
                    marginLeft: 10,
                    marginRight: 10,
                },
            },
        },
        MuiTextField: {
            styleOverrides: {
                root: {
                    backgroundColor: "#EAEEF3",
                    "& input": {
                        borderColor: "transparent !important",
                        boxShadow: "0 0 0 transparent",
                    },
                    "& input:focus": {
                        backgroundColor: "#F1F2F3",
                    },
                },
            },
        },
        MuiInput: {
            styleOverrides: {
                root: {
                    backgroundColor: "#EAEEF3",
                    // outlineColor:"#0060ff",
                    // color:"#0060ff",
                    // borderColor:"#0060ff"
                },
            },
        },
        MuiInputBase: {
            // variants:{
            // }
            // defaultProps: {
            //     fullWidth,
            //     size: "small",
            //     variant: "outlined",
            // },
            //   styleOverrides: {
            //     input: {
            //       borderColor:"transparent",
            //         backgroundColor: "#EAEEF3",
            //         outlineColor:"#0060ff",
            //         color:"#0060ff",
            //         borderColor:"#0060ff"
            //     },
            // },
        },
        // MuiSelect: {
        //     styleOverrides: {
        //         root: {
        //             backgroundColor: "#EAEEF3",
        //         },
        //     },
        // },
        MuiFormControl: {
            styleOverrides: {
                root: {
                    backgroundColor: "#EAEEF3",
                },
            },
        },
        MuiBottomNavigationAction: {
            styleOverrides: {
                root: {
                    px: 3,
                },
            },
        },
        MuiTabs: {
            styleOverrides: {
                flexContainer: {
                    justifyContent: "center",
                },
            },
        },
        // MuiGrid: {
        //     styleOverrides: {
        //         item: {
        //             padding: "0 !important",
        //             margin: "0 !important"
        //         },
        //     },
        // },
    },
});

export default customTheme;
