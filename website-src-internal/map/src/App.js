import React from 'react';

// components
import OsmAndMapFrame from "./components/OsmAndMapFrame";
import { AppContextProvider} from "./context/AppContext"



const App = () => {


  return (
    <AppContextProvider>
        <OsmAndMapFrame />
    </AppContextProvider>
  );
};

export default App;