import Axios from 'axios';
import React, {useState} from 'react';
import ReactDOM from 'react-dom';
import UserDetailEditor from './UserDetailEditor';

function UserHome(props) {
  const [user, setUser] = useState(_params.user);
  const handleChangeUser = (event, propertyName) => {
    const newUser = Object.assign({}, user);
    newUser[propertyName] = event.target.value;
    setUser(newUser);
  };
  const handleSave = () => {
    const params = {
      name: user.name,
      email: user.email,
      bio: user.bio
    };
    Axios.put('/users/' + user.id, params)
      .then(res => {
        alert('正常に更新されました');
      })
      .catch(error => {
        console.error(error);
      })
  };
  return (
    <>
      {user.id === _params.authenticatedUserId &&
        <UserDetailEditor
          user={user}
          handleChangeUser={handleChangeUser}
          handleSave={handleSave}
        />
      }
    </>
  );
}

export default UserHome;

if (document.getElementById('user-root')) {
    ReactDOM.render(<UserHome />, document.getElementById('user-root'));
}
