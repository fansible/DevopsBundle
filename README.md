# FansibleDevopsBundle

This will help you to generate a Ansible provisioning to run your Symfony apps.

##Requirements
This have been tested with the Ubuntu OS. It should work with many other various Linux distribution. Feel free to share your advice for the other OS..
You will need to install if you haven't done yet:

* [Ansible](http://docs.ansible.com/intro_installation.html)
* [Composer](https://getcomposer.org/download/)
* [Vagrant](http://www.vagrantup.com/downloads.html)
* [VirtualBox](https://www.virtualbox.org/wiki/Downloads).
* nfs `sudo apt-get install nfs-kernel-server`

1) Add "fansible/devops-bundle": "dev-master" in your composer.json and run: `composer update` to install it.

2) Enable the bundle in the `app/AppKernel.php` file.
Add `$bundles[] = new \Fansible\DevopsBundle\FansibleDevopsBundle();`

3) Add the following in your configuration in

    fansible_devops:
      name: fansible-devops
      ansible_roles:
        apache:
          name: FAKE.apache
          version: v24
      environments:
        vagrant:
          ip: 8.0.0.8
          host: fansible-devops.dev
        prod:
          ip: x.x.x.x
          host: fansible-devops.prod

4) Now you can use our command to generate all the files you need to your provisioning. `app/console devops:provisioning:generate`

5) To be able to correctly provision your server, ansible needs some role that are describe in the requirements.txt file.
You need to download them by running `ansible-galaxy install -r requirements.txt`.

6)Now you can run `vagrant up` to start your vagrant. It is lunched using the Vagrantfile that we have just generated.
