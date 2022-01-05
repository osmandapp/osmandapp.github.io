import React from 'react';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
// components
import OsmAndMapFrame from './components/OsmAndMapFrame';
import LoginDialog from './components/LoginDialog';
import { AppContextProvider} from './context/AppContext'



const App = () => {
  const [loginDialog, setLoginDialog] = React.useState(false);
  return (
    <AppContextProvider>
      <BrowserRouter>
        <Routes>
          <Route path="/map/loginForm" element={<LoginDialog open={loginDialog} setOpen={setLoginDialog} />}>
          </Route>
          <Route path="/map" element={<OsmAndMapFrame />}>
          </Route>
        </Routes>
      </BrowserRouter>
    </AppContextProvider>
  );
};

export default App;