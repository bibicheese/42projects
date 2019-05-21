/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   main.c                                             :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: nkellum <nkellum@student.42.fr>            +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/03 15:10:14 by nkellum           #+#    #+#             */
/*   Updated: 2019/05/20 17:38:16 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#include "ft_ls.h"

int main (int ac, char **av)
{
  	struct dirent 	*pDirent;
   	DIR 			*pDir;

	if (ac == 1)
		ft_oneac(pDir, pDirent); 			// Pour si y a pas d'args
	ft_manyac(pDir, pDirent, ac, av);		// Pour si y a des args
	return (0);
}
