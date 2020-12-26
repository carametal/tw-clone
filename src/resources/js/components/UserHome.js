import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import UserDetail from './UserDetail';

function UserHome(props) {
  const [user, setUser] = useState(_params.user);
  return (
    <>
      <UserDetail
        user={user}
      />
    </>
  );
}

export default UserHome;

if (document.getElementById('user-root')) {
    ReactDOM.render(<UserHome />, document.getElementById('user-root'));
}
