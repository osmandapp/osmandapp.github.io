import React from 'react';
import {Box, Typography} from "@mui/material";

const GpxStat = (props) => {

    return (<div>
            {props.stat.map(item => {
                return (
                    <Box key={item}>
                        <Typography variant="subtitle1" color="inherit" >
                            {item}
                        </Typography>
                    </Box>
                );
            })}
    </div>
    )
};

export default GpxStat;