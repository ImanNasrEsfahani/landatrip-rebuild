import React from "react";
import {
    TableCell,
    TableRow,
    tableCellClasses
} from "@mui/material";
import Skeleton from '@mui/material/Skeleton';
import {styled} from "@mui/material/styles";

const StyledTableCell = styled(TableCell)(({theme}) => ({
    [`&.${tableCellClasses.head}`]: {
        backgroundColor: "primary.main",
        color: "primary.main",
    },
    [`&.${tableCellClasses.body}`]: {
        fontSize: 14,
    },
}));

const StyledTableRow = styled(TableRow)(({theme}) => ({
    '&:nth-of-type(odd)': {
        backgroundColor: "#fafafa",
    },
    '&:nth-of-type(even)': {
        backgroundColor: "#EAEEF3",
    },
    '&:last-child td, &:last-child th': {
        border: 0,
    },
}));

export default function TableSkeleton(cel) {
    const tableCells = []
    for (let i = 0; i < cel.cel; i++) {
        tableCells.push(
            <StyledTableCell align="center">
                <Skeleton variant="rectangular" animation="wave"
                          width="70%"
                          height="35px" sx={{
                    margin: "auto",
                    borderRadius: "25px"
                }}/>
            </StyledTableCell>)
    }
    return Array(5).fill({}).map((value, key) => {
        return (
            <StyledTableRow>
                {tableCells}
            </StyledTableRow>
        )
    })
}

