import * as React from 'react';
import { makeStyles, styled } from '@mui/material/styles';
import Stepper from '@mui/material/Stepper';
import Step from '@mui/material/Step';
import StepLabel from '@mui/material/StepLabel';
import GroupAddIcon from '@mui/icons-material/GroupAdd';
import StepConnector, { stepConnectorClasses } from '@mui/material/StepConnector';
import { StepIconProps } from '@mui/material/StepIcon';
import Step1 from './Step1';
import Step2 from './Step2';
import Step3 from './Step3';
import Step4 from './Step4';
import Step5 from './Step5';
import Step6 from './Step6';
import { Box, Button, TextField, Typography } from '@mui/material';
import customTheme from '../../custom';
import LocalAirportIcon from '@mui/icons-material/LocalAirport';
import ApartmentIcon from '@mui/icons-material/Apartment';
import MedicalServicesIcon from '@mui/icons-material/MedicalServices';
import DescriptionIcon from '@mui/icons-material/Description';
import PaidIcon from '@mui/icons-material/Paid';
import Sidebar from "./Sidebar";
import NavigateNextIcon from '@mui/icons-material/NavigateNext';
import ChevronLeftIcon from '@mui/icons-material/ChevronLeft';
const color : any = customTheme.palette;

declare module '@mui/material/Typography' {
  interface TypographyPropsVariantOverrides {
      h2Semibold: true;
      h2Bold: true;
      h3Semibold: true;
      h3Bold: true;
      h4Semibold: true;
      h4Bold: true;
      h5Semibold: true;
      h5Bold: true;
      h6Semibold: true;
      h6Bold: true;
      body1Semibold: true;
      body1Bold: true;
      subtitle1Semibold: true;
      subtitle1Bold: true;
      subtitle2Semibold: true;
      subtitle2Bold: true;
  }
}




const ColorlibConnector = styled(StepConnector)(({ theme }) => ({
  [`&.${stepConnectorClasses.alternativeLabel}`]: {
    top: 18,
  },
  [`&.${stepConnectorClasses.active}`]: {
    [`& .${stepConnectorClasses.line}`]: {
      backgroundColor:color.step,
      height : "0px",
      borderBottom : "2px solid ",
      borderColor : color.primary.main

    },
  },
  [`&.${stepConnectorClasses.completed}`]: {
    [`& .${stepConnectorClasses.line}`]: {
      height : "0px",
      borderBottom : "2px solid ",
      borderColor : color.primary.main

    },
  },
  [`& .${stepConnectorClasses.line}`]: {
    border : 0,
    height: 2, /* ارتفاع المان */
    backgroundImage: `linear-gradient(to right, ${color.gray.tint2} 50%, transparent 50%, transparent)`,
    backgroundSize: "40px 100%", /* طول و ارتفاع خط چین */
    backgroundRepeat: "repeat",
  },
}));

const ColorlibStepIconRoot = styled('div')<{
  ownerState: { completed?: boolean; active?: boolean };
}>(({ theme, ownerState }) => ({
  backgroundColor: theme.palette.mode === 'dark' ? theme.palette.grey[700] : color.gray.tint3,
  zIndex: 1,
  color: '#fff',
  width:40,
  height: 40,
  display: 'flex',
  borderRadius: '50%',
  justifyContent: 'center',
  alignItems: 'center',
  ...(ownerState.active && {
    backgroundColor:"transparent",
    border : "1px solid",
    borderColor : color.primary.main
  }),
  ...(ownerState.completed && {
    backgroundColor:color.primary.main,
  }),
}));

function ColorlibStepIcon(props: StepIconProps) {
  const { active, completed, className } = props;


  const icons: { [index: string]: React.ReactElement } = {
    // 1: <GroupAddIcon sx={{color : active ?  color.primary.main : color.gray.main }} />,
    1: <GroupAddIcon  sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }} />,
    2: <LocalAirportIcon sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }}/>,
    3: <ApartmentIcon sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }}/>,
    4: <MedicalServicesIcon sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }}/>,
    5: <DescriptionIcon sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }}/>,
    6: <PaidIcon sx={{color: active ? color.primary.main : completed ? "white" : color.gray.main }}/>,
  };

  return (
    <ColorlibStepIconRoot ownerState={{ completed, active }} className={className}>
      {icons[String(props.icon)]}
    </ColorlibStepIconRoot>
  );
}

const steps = ['Select your companions', 'Transportation', 'Accommodation' , 'Additional Services'  , 'Invoice' , "Payment" ];

export default function Steppers() {
  const [activeStep, setActiveStep] = React.useState(0);
  const handleNext = () => {
    setActiveStep((prevActiveStep) => prevActiveStep + 1);
    scroll(1,1)
  };
  
  const handleBack = () => {
    setActiveStep((prevActiveStep) => prevActiveStep - 1);
    scroll(1,1)
  };


  
  return (
   
    <>
      <Stepper alternativeLabel  activeStep={activeStep} connector={<ColorlibConnector />}>
        {steps.map((label) => (
          <Step key={label}>
            <StepLabel
             StepIconComponent={ColorlibStepIcon}
             sx={{
              '.MuiStepLabel-label': {
                color: 'gray.tone2', 
                '&.Mui-active': {
                  color: 'primary.main', 
                },
                '&.Mui-completed': {
                  color: 'black',
                },
              }
            }}
            >
              {screen.width > 760 ? <Typography variant='body1Bold' component="p">{label}</Typography> : null}
            </StepLabel>
          </Step>
        ))}
      </Stepper>


      <Box sx={{
        px : 2
      }}
      >
        {activeStep === 0 && (  
            <Step1/>
        )}
        {activeStep === 1 && (
            <Step2/>
        )}
        {activeStep === 2 && (
            <Step3/>
        )}
        {activeStep === 3 && (
            <Step4/>
        )}
        {activeStep === 4 && (
            <Step5/>
        )}
        {activeStep === 5 && (
            <Step6/>
        )}
      </Box>
      
      <Box display={{lg : "none"}} mx={4} mt={3}>
        <Sidebar/>
      </Box>

      <Box sx={{display : "flex", justifyContent : "center" , mt : 6}}>
        {activeStep === 0 ? null : 
              <Button
              variant='contained'
                disabled={activeStep === 0}
                onClick={handleBack}
                startIcon={<ChevronLeftIcon/>}
                sx={{bgcolor: color.tertiary.main , ml : 5 , p : "10px 40px" , textTransform : "none", borderRadius : "12px" , marginRight: 1 ,color : "white"}}
              >
                Back
              </Button>
        }
        {activeStep === 5 ? 
          <Button
          variant='contained'
            type='button'
            sx={{bgcolor: color.tertiary.main , ml : 5 , p : "10px 40px" , textTransform : "none" , borderRadius : "12px", color : "white" , marginRight: 1  }}
          >
            Pay
          </Button>
        : 
          <Button
          variant='contained'
            disabled={activeStep === 5}
            onClick={handleNext}
            type='button'
            endIcon={<NavigateNextIcon/>}
            sx={{bgcolor: color.tertiary.main , ml : 5 , p : "10px 40px" , textTransform : "none" , borderRadius : "12px", color : "white" , marginRight: 1 }}
          >
            Next
          </Button>
        }
      </Box>
    </>
    
  );
}


