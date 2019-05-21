/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: jmondino <jmondino@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/05/20 16:58:28 by jmondino          #+#    #+#             */
/*   Updated: 2019/05/20 18:40:17 by jmondino         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
#define FT_LS_H

#include <stdio.h>
#include <dirent.h>
#include <stdlib.h>

void	ft_oneac(DIR *pDir, struct dirent *pDirent);
void	ft_manyac(DIR *pDir, struct dirent *pDirent, int ac, char **av);
void	ft_parse(DIR *pDir, struct dirent *pDirent);
int		ft_strlen(char *str);

#endif
