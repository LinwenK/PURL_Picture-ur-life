import { Link } from 'react-router-dom';
import vidsrc from '../img/home.mp4'

function Home(){
  return(
    <>
      <div id = 'home'>
        <video muted autoPlay loop className='v-home'>
            <source src={vidsrc} type='video/mp4'/>
        </video>
        <div id = 'option'>
            <div className='button1'> 
                <Link to="/main">Explore this world</Link>
            </div> 
            <div className='button2'>
                <Link to="/login">Log in</Link>
            </div>   
        </div>
      </div>
    </>
  )
}
export default Home;