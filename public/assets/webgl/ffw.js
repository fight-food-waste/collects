if (WEBGL.isWebGLAvailable() === false) {
    document.body.appendChild(WEBGL.getWebGLErrorMessage());
}

// Init variables for global scope
var container, stats, controls, position;
var camera, scene, renderer, light, elf, city, floorMat;
var x, y, z;
var materials;
var cube, cart, cartMesh, stockMesh, deliveryMesh, bgScene;
var mixer = [];

init();
animate();


function init() {
    container = document.createElement('div');
    document.body.appendChild(container);
    camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 1, 100000);
    camera.position.set(-2500, 3000, 2000);

    controls = new THREE.OrbitControls(camera);
    controls.target.set(0, 100, 0);
    controls.update();

    scene = new THREE.Scene();
    bgScene = new THREE.Scene();

    // Load models for scene
    var loadingManager = new THREE.LoadingManager(function () {
        scene.add(elf);
        scene.add(city);
        scene.add(hospital);
    });

    // Collada
    var colladaLoader = new THREE.ColladaLoader(loadingManager);
    colladaLoader.load('assets/webgl/models/collada/truck.dae', function (collada) {
        elf = collada.scene;
        elf.scale.set(3, 3, 3);
        elf.position.set(0, 30, 0);
        elf.rotation.z = -Math.PI / 2;
        scene.add(elf);
    });

    colladaLoader.load('assets/webgl/models/collada/model.dae', function (collada) {
        city = collada.scene;
        city.scale.set(3, 3, 3);
        scene.add(city);
    });

    colladaLoader.load('assets/webgl/models/collada/hospital.dae', function (collada) {
        hospital = collada.scene;
        hospital.scale.set(3, 3, 3);
        hospital.rotation.z = -Math.PI / 2;
        hospital.position.set(1500, 30, -8500);
        scene.add(hospital);
    });

    // Add Lights
    light = new THREE.HemisphereLight(0xffffff, 0x444444);
    light.position.set(0, 200, 0);
    scene.add(light);

    light = new THREE.DirectionalLight(0xffffff);
    light.position.set(0, 200, 100);
    light.castShadow = true;
    light.shadow.camera.top = 180;
    light.shadow.camera.bottom = -100;
    light.shadow.camera.left = -120;
    light.shadow.camera.right = 120;
    scene.add(light);

    // Load floor texture
    floorMat = new THREE.MeshStandardMaterial({
        roughness: 0.8,
        color: 0xffffff,
        metalness: 0.2,
        bumpScale: 0.0005
    });

    var TextureLoader = new THREE.TextureLoader();
    TextureLoader.load('assets/webgl/textures/bitume.jpg', function (map) {
        map.wrapS = THREE.RepeatWrapping;
        map.wrapT = THREE.RepeatWrapping;
        map.anisotropy = 4;
        map.repeat.set(10, 24);
        floorMat.map = map;
        floorMat.needsUpdate = true;
    });

    TextureLoader.load('assets/webgl/textures/bitume.jpg', function (map) {
        map.wrapS = THREE.RepeatWrapping;
        map.wrapT = THREE.RepeatWrapping;
        map.anisotropy = 4;
        map.repeat.set(10, 24);
        floorMat.bumpMap = map;
        floorMat.needsUpdate = true;
    });

    TextureLoader.load('assets/webgl/textures/bitume.jpg', function (map) {
        map.wrapS = THREE.RepeatWrapping;
        map.wrapT = THREE.RepeatWrapping;
        map.anisotropy = 4;
        map.repeat.set(10, 24);
        floorMat.roughnessMap = map;
        floorMat.needsUpdate = true;
    });


    // Create floor and add texture to the mesh
    var floorGeometry = new THREE.PlaneBufferGeometry(15800, 9000);

    var floorMesh = new THREE.Mesh(floorGeometry, floorMat);
    floorMesh.receiveShadow = true;
    floorMesh.rotation.x = -Math.PI / 2.0;
    floorMesh.position.set(-4500, 40, -4200);
    scene.add(floorMesh);

    // Skybox
    const skybox_image_path = 'assets/webgl/textures/Ely1/Ely1_';
    const skybox_directions = ["nx", "px", "py", "ny", "nz", "pz"];
    const skybox_image_type = ".jpg";
    let skybox_materials = [];
    for (let i = 0; i < 6; i++) {
        skybox_materials.push(new THREE.MeshBasicMaterial({
            map: THREE.ImageUtils.loadTexture(skybox_image_path + skybox_directions[i] + skybox_image_type),
            side: THREE.BackSide
        }));
    }
    let sky_geometry = new THREE.CubeGeometry(18000, 5000, 10000);
    let sky_material = new THREE.MeshFaceMaterial(skybox_materials);
    skybox = new THREE.Mesh(sky_geometry, sky_material);
    skybox.position.set(-4000, 200, -3800);

    scene.add(skybox);

    var textureCart = new THREE.TextureLoader().load('assets/webgl/textures/cartShop.jpg');
    var geometryCart = new THREE.BoxBufferGeometry(300, 300, 300);
    var materialCart = new THREE.MeshBasicMaterial({map: textureCart});
    cartMesh = new THREE.Mesh(geometryCart, materialCart);
    cartMesh.position.set(100, 400, -800);
    scene.add(cartMesh);

    var textureStock = new THREE.TextureLoader().load('assets/webgl/textures/carton.jpg');
    var geometryStock = new THREE.BoxBufferGeometry(300, 150, 150);
    var materialStock = new THREE.MeshBasicMaterial({map: textureStock});
    stockMesh = new THREE.Mesh(geometryStock, materialStock);
    stockMesh.position.set(-2000, 400, -1900);
    scene.add(stockMesh);

    var textureDelivery = new THREE.TextureLoader().load('assets/webgl/textures/stock.jpg');
    var geometryDelivery = new THREE.BoxBufferGeometry(300, 300, 300);
    var materialDelivery = new THREE.MeshBasicMaterial({map: textureDelivery});
    deliveryMesh = new THREE.Mesh(geometryDelivery, materialDelivery);
    deliveryMesh.position.set(-2400, 400, -6800);
    scene.add(deliveryMesh);

    // Van
    var fbxLoader = new THREE.FBXLoader();
    fbxLoader.load('assets/webgl/models/fbx/VAN.fbx', function (object) {
        object.mixer = new THREE.AnimationMixer(object);

        mixer.push(object.mixer);
        object.traverse(function (child) {
            if (child.isMesh) {
                child.castShadow = true;
                child.receiveShadow = true;
            }
        });
        scene.add(object);
    });


    // WebGL
    renderer = new THREE.WebGLRenderer({antialias: true});
    renderer.setPixelRatio(window.devicePixelRatio);
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.shadowMap.enabled = true;
    container.appendChild(renderer.domElement);
    window.addEventListener('resize', onWindowResize, false);

    stats = new Stats();
    container.appendChild(stats.dom);

    const axe = new THREE.AxesHelper(1000);
    scene.add(axe);

}

function onWindowResize() {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
}

function animate() {
    requestAnimationFrame(animate);

    renderer.render(scene, camera);

    // Van movements
    if (elf.position.z > -1900) {
        elf.position.z -= 10;
    } else if (elf.position.z === -1900) {
        if (elf.rotation.z < Math.PI / 180) {
            elf.rotation.z += 0.01;
            elf.position.x -= 3;
        } else if (elf.rotation.z > Math.PI / 180) {
            elf.position.x -= 10;
            elf.position.z += 0.001;

        }
    } else if (elf.position.z === -1909.999 && elf.position.x > -2400) {
        elf.position.x -= 10;
    } else if (elf.position.x === -2407) {
        if (elf.rotation.z > -1.5907963267948966) {
            elf.rotation.z -= 0.01;
            elf.position.z -= 4;
        } else if (elf.rotation.z <= -1.5907963267948966) {
            elf.position.z -= 10;
        }
    }

    cartMesh.rotation.y += 0.01;
    cartMesh.rotation.x -= 0.02;


    // Remove carts when Van cross them
    var distance = elf.position.distanceTo(cartMesh.position);
    if (distance <= 685 && distance <= 580) {
        scene.remove(cartMesh);
    }

    var distance2 = elf.position.distanceTo(stockMesh.position);
    if (distance2 <= 380) {
        scene.remove(stockMesh);
    }

    var distance3 = elf.position.distanceTo(deliveryMesh.position);
    if (distance3 <= 380) {
        scene.remove(deliveryMesh);
    }

    stats.update();
}